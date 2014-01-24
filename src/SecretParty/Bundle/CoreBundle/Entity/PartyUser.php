<?php

namespace SecretParty\Bundle\CoreBundle\Entity;


class PartyUser {
    /**
     * @var Party
     */
    private $party;

    /**
     * @var User
     */
    private $user;

    /**
     * @param mixed $party
     */
    public function setParty(Party $party)
    {
        $this->party = $party;
    }

    /**
     * @return mixed
     */
    public function getParty()
    {
        return $this->party;
    }

    /**
     * @param mixed $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }


} 