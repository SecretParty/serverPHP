<?php

namespace SecretParty\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Secrets
 *
 * @ORM\Table(name="secretpartycore_secrets")
 * @ORM\Entity(repositoryClass="SecretParty\Bundle\CoreBundle\Entity\SecretsRepository")
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
     * @var string
     *
     * @ORM\Column(name="name", type="text")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="indication", type="text")
     */
    private $indication;



    /**
     * @ORM\ManyToOne(targetEntity="Thematic")
     * @ORM\JoinColumn(name="thematic_id", referencedColumnName="id")
     */
    private $thematic;

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
     * Set indication
     *
     * @param string $indication
     * @return Secrets
     */
    public function setIndication($indication)
    {
        $this->indication = $indication;

        return $this;
    }

    /**
     * Get indication
     *
     * @return string 
     */
    public function getIndication()
    {
        return $this->indication;
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
