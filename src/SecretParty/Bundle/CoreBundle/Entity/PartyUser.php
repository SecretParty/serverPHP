<?php

namespace SecretParty\Bundle\CoreBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;


class PartyUser {
    /**
     * @var Party
     * @Assert\NotBlank()
     */
    private $party;

    /**
     * @var User
     * @Assert\NotBlank()
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