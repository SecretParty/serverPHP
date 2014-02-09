<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 25/01/2014
 * Time: 16:13
 */

namespace SecretParty\Bundle\CoreBundle\EventListener;


use Doctrine\ORM\EntityManager;
use SecretParty\Bundle\CoreBundle\Event\BuzzEvent;
use SecretParty\Bundle\CoreBundle\Exception\PartyLogicalException;

class BuzzEventListener {

    /**
     * @var EntityManager
     */
    private $em;

    public function __construct(EntityManager $em){
        $this->em = $em;
    }

    public function checkNoFinishParty(BuzzEvent $event){
        $buzz = $event->getBuzz();

        // Check if party isn't finish.
        if($buzz->getBuzzer()->getParty()->getTimestamp()+$buzz->getBuzzer()->getParty()->getLength() < time()){
            throw new PartyLogicalException('Party is finish');
        }
    }

    public function checkSameParty(BuzzEvent $event){
        $buzz = $event->getBuzz();

        if($buzz->getBuzzer()->getParty() != $buzz->getBuzzee()->getParty()){
            throw new PartyLogicalException('Error party buzzer/buzzee');
        }
    }

    public function checkSameUser(BuzzEvent $event){
        $buzz = $event->getBuzz();

        if($buzz->getBuzzer() == $buzz->getBuzzee()){
            throw new PartyLogicalException('Error buzzer and buzzee are the same');
        }
    }

    public function checkUniqueBuzz(BuzzEvent $event){
        $buzz = $event->getBuzz();
        $buzzs = $this->em->getRepository("SecretPartyCoreBundle:Buzz")->findOneBy(array("buzzer" => $buzz->getBuzzer(),"buzzee"=>$buzz->getBuzzee()));
        if(!empty($buzzs)){
            throw new PartyLogicalException('Error buzzer have already buzz buzzee');
        }
    }
}