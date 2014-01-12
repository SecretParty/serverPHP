<?php

namespace SecretParty\Bundle\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


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
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @var Secrets
     *
     * @ORM\OneToMany(targetEntity="Secrets", mappedBy="thematic", cascade={"persist"})
     */

    private $secrets;

    function __construct()
    {
        $this->secrets = new ArrayCollection();
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
}
