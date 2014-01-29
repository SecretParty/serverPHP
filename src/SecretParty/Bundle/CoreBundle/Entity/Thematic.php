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

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as JMS;


/**
 * Thematic
 *
 * @ORM\Table(name="secretpartycore_thematic")
 * @ORM\Entity(repositoryClass="SecretParty\Bundle\CoreBundle\Entity\Repository\ThematicRepository")
 */
class Thematic
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMS\Groups({"party", "thematic"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotBlank()
     * @JMS\Groups({"party", "thematic"})
     */
    private $name;

    /**
     * @var Secrets
     *
     * @ORM\OneToMany(targetEntity="Secrets", mappedBy="thematic", cascade={"persist"})
     * @JMS\Groups({"thematic"})
     */
    private $secrets;

    /**
     * @var Party
     *
     * @ORM\OneToMany(targetEntity="Party", mappedBy="thematic", cascade={"persist"})
     */
    private $parties;

    function __construct()
    {
        $this->secrets = new ArrayCollection();
        $this->parties = new ArrayCollection();
    }


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
     * @return Thematic
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
     * Add secrets
     *
     * @param \SecretParty\Bundle\CoreBundle\Entity\Secrets $secrets
     * @return Thematic
     */
    public function addSecret(\SecretParty\Bundle\CoreBundle\Entity\Secrets $secrets)
    {
        if(!$this->secrets->contains($secrets))
            $this->secrets[] = $secrets;
        return $this;
    }

    /**
     * Remove secrets
     *
     * @param \SecretParty\Bundle\CoreBundle\Entity\Secrets $secrets
     */
    public function removeSecret(\SecretParty\Bundle\CoreBundle\Entity\Secrets $secrets)
    {
        $this->secrets->removeElement($secrets);
    }

    /**
     * Get secrets
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSecrets()
    {
        return $this->secrets;
    }

    /**
     * Add parties
     *
     * @param \SecretParty\Bundle\CoreBundle\Entity\Party $parties
     * @return Thematic
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
