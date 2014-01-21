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
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Secrets
 *
 * @ORM\Table(name="secretpartycore_secrets")
 * @ORM\Entity(repositoryClass="SecretParty\Bundle\CoreBundle\Entity\Repository\SecretsRepository")
 */
class Secrets
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
     * @var Thematic
     *
     * @ORM\ManyToOne(targetEntity="Thematic", inversedBy="secrets")
     * @ORM\JoinColumn(name="thematic_id", referencedColumnName="id")
     */
    private $thematic;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="text")
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="hint", type="text")
     * @Assert\NotBlank()
     */
    private $hint;

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
     * @return Secrets
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
     * Set hint
     *
     * @param string $hint
     * @return Secrets
     */
    public function setHint($hint)
    {
        $this->hint = $hint;

        return $this;
    }

    /**
     * Get hint
     *
     * @return string 
     */
    public function getHint()
    {
        return $this->hint;
    }

    /**
     * Set thematic
     *
     * @param \SecretParty\Bundle\CoreBundle\Entity\Thematic $thematic
     * @return Secrets
     */
    public function setThematic(\SecretParty\Bundle\CoreBundle\Entity\Thematic $thematic = null)
    {
        $this->thematic = $thematic;

        return $this;
    }

    /**
     * Get thematic
     *
     * @return \SecretParty\Bundle\CoreBundle\Entity\Thematic 
     */
    public function getThematic()
    {
        return $this->thematic;
    }
}
