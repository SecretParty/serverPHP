<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 25/01/2014
 * Time: 16:04
 */

namespace SecretParty\Bundle\CoreBundle\Event;


use SecretParty\Bundle\CoreBundle\Entity\Party;
use SecretParty\Bundle\CoreBundle\Entity\User;
use Symfony\Component\EventDispatcher\Event;

class JoinUserEvent extends Event{


    /**
     * @var \SecretParty\Bundle\CoreBundle\Entity\Party
     */
    protected $party;

    function __construct( Party $party)
    {
        $this->party = $party;
    }

    /**
     * @return \SecretParty\Bundle\CoreBundle\Entity\Party
     */
    public function getParty()
    {
        return $this->party;
    }



} 