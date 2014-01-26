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
     * @var \SecretParty\Bundle\CoreBundle\Entity\User
     */
    protected $user;

    function __construct( User $user)
    {
        $this->user = $user;
    }

    /**
     * @return \SecretParty\Bundle\CoreBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }



} 