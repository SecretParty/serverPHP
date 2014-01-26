<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 25/01/2014
 * Time: 16:13
 */

namespace SecretParty\Bundle\CoreBundle\EventListener;


use SecretParty\Bundle\CoreBundle\Event\JoinUserEvent;
use SecretParty\Bundle\CoreBundle\Exception\PartyLogicalException;

class JoinUserEventListener {

    public function onJoinUserEvent(JoinUserEvent $event){
        $user = $event->getUser();

        $end = $user->getParty()->getDate()->add(new \DateInterval('PT'.$user->getParty()->getLength().'S'));

        // Check if end date is not passed
        if($end <= new \DateTime()){
            throw new PartyLogicalException("Party is finish.");
        }
    }

} 