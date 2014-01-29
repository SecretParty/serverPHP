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

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

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
     * @JMS\Groups({"party", "user"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @JMS\Groups({"party", "user"})
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @var Secrets
     *
     * @ORM\ManyToOne(targetEntity="Secrets")
     * @ORM\JoinColumn(name="secret_id", referencedColumnName="id")
     * @Assert\NotBlank()
     */
    private $secret;

    /**
     * @var Party
     *
     * @ORM\ManyToMany(targetEntity="Party")
     */
    private $parties;

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
     * Constructor
     */
    public function __construct()
    {
        $this->parties = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add parties
     *
     * @param \SecretParty\Bundle\CoreBundle\Entity\Party $parties
     * @return User
     */
    public function addParty(\SecretParty\Bundle\CoreBundle\Entity\Party $parties)
    {
        $this->parties[] = $parties;

        return $this;
    }

    /**
     * Remove parties
     *
     * @param \SecretParty\Bundle\CoreBundle\Entity\Party $parties
     */
    public function removeParty(\SecretParty\Bundle\CoreBundle\Entity\Party $parties)
    {
        $this->parties->removeElement($parties);
    }

    /**
     * Get parties
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getParties()
    {
        return $this->parties;
    }
}
