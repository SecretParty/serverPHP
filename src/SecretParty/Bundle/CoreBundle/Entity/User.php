<?php

/*
    Copyright (C) 2014 Hugo DJEMAA / Jérémie BOUTOILLE / Mickael GOUBIN /
    David LIVET - http://github.com/SecretParty/serverPHP

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see [http://www.gnu.org/licenses/].
*/


namespace SecretParty\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="secretpartycore_user")
 * @ORM\Entity(repositoryClass="SecretParty\Bundle\CoreBundle\Entity\Repository\UserRepository")
 */
class User
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var Secrets
     *
     * @ORM\ManyToOne(targetEntity="Secrets")
     * @ORM\JoinColumn(name="secret_id", referencedColumnName="id")
     */
    private $secret;

    /**
     * @var Party
     *
     * @ORM\ManyToOne(targetEntity="Party")
     * @ORM\JoinColumn(name="party_id", referencedColumnName="id")
     */
    private $party;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set secret
     *
     * @param \SecretParty\Bundle\CoreBundle\Entity\Secrets $secret
     * @return User
     */
    public function setSecret(\SecretParty\Bundle\CoreBundle\Entity\Secrets $secret = null)
    {
        $this->secret = $secret;

        return $this;
    }

    /**
     * Get secret
     *
     * @return \SecretParty\Bundle\CoreBundle\Entity\Secrets 
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * Set party
     *
     * @param \SecretParty\Bundle\CoreBundle\Entity\Party $party
     * @return User
     */
    public function setParty(\SecretParty\Bundle\CoreBundle\Entity\Party $party = null)
    {
        $this->party = $party;

        return $this;
    }

    /**
     * Get party
     *
     * @return \SecretParty\Bundle\CoreBundle\Entity\Party 
     */
    public function getParty()
    {
        return $this->party;
    }
}
