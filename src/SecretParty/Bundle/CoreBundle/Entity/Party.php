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
 * Party
 *
 * @ORM\Table(name="secretpartycore_party")
 * @ORM\Entity(repositoryClass="SecretParty\Bundle\CoreBundle\Entity\Repository\PartyRepository")
 */
class Party
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
     * @var integer
     *
     * @ORM\Column(name="lenght", type="integer")
     */
    private $lenght;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var Thematic
     *
     * @ORM\ManyToOne(targetEntity="Thematic")
     * @ORM\JoinColumn(name="thematic_id", referencedColumnName="id")
     */
    private $thematic;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="User", mappedBy="thematic", cascade={"persist"})
     */
    private $users;

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
     * @return Party
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
     * Set lenght
     *
     * @param integer $lenght
     * @return Party
     */
    public function setLenght($lenght)
    {
        $this->lenght = $lenght;

        return $this;
    }

    /**
     * Get lenght
     *
     * @return integer 
     */
    public function getLenght()
    {
        return $this->lenght;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Party
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set thematic
     *
     * @param \SecretParty\Bundle\CoreBundle\Entity\Thematic $thematic
     * @return Party
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

    /**
     * Add users
     *
     * @param \SecretParty\Bundle\CoreBundle\Entity\User $users
     * @return Party
     */
    public function addUser(\SecretParty\Bundle\CoreBundle\Entity\User $users)
    {
        $this->users[] = $users;

        return $this;
    }

    /**
     * Remove users
     *
     * @param \SecretParty\Bundle\CoreBundle\Entity\User $users
     */
    public function removeUser(\SecretParty\Bundle\CoreBundle\Entity\User $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }
}
