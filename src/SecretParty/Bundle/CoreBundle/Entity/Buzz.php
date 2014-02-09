<?php

namespace SecretParty\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * Buzz
 *
 * @ORM\Table(name="secretpartycore_buzz")
 * @ORM\Entity(repositoryClass="SecretParty\Bundle\CoreBundle\Entity\Repository\BuzzRepository")
 */
class Buzz
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     * @JMS\Groups({"resultat"})
     */
    private $date;

    /**
     * @var UserPartySecret
     *
     * @ORM\ManyToOne(targetEntity="UserPartySecret")
     * @ORM\JoinColumn(name="buzzed_id", referencedColumnName="id")
     */
    private $buzzer;

    /**
     * @var UserPartySecret
     *
     * @ORM\ManyToOne(targetEntity="UserPartySecret", inversedBy="buzzers")
     * @ORM\JoinColumn(name="buzzee_id", referencedColumnName="id")
     */
    private $buzzee;

    /**
     * @var Secrets
     *
     * @ORM\ManyToOne(targetEntity="Secrets")
     * @ORM\JoinColumn(name="secret_id", referencedColumnName="id")
     * @JMS\Groups({"resultat"})
     */
    private $secret;

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
     * Set date
     *
     * @param \DateTime $date
     * @return Buzz
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
     * Set secret
     *
     * @param \SecretParty\Bundle\CoreBundle\Entity\Secrets $secret
     * @return Buzz
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
     * Set buzzer
     *
     * @param \SecretParty\Bundle\CoreBundle\Entity\UserPartySecret $buzzer
     * @return Buzz
     */
    public function setBuzzer(\SecretParty\Bundle\CoreBundle\Entity\UserPartySecret $buzzer = null)
    {
        $this->buzzer = $buzzer;

        return $this;
    }

    /**
     * Get buzzer
     *
     * @return \SecretParty\Bundle\CoreBundle\Entity\UserPartySecret 
     */
    public function getBuzzer()
    {
        return $this->buzzer;
    }

    /**
     * Get buzzer
     *
     * @return \SecretParty\Bundle\CoreBundle\Entity\UserPartySecret
     * @JMS\VirtualProperty
     * @JMS\Groups({"resultat"})
     */
    public function getBuzzerId()
    {
        return $this->buzzer->getId();
    }

    /**
     * Set buzzee
     *
     * @param \SecretParty\Bundle\CoreBundle\Entity\UserPartySecret $buzzee
     * @return Buzz
     */
    public function setBuzzee(\SecretParty\Bundle\CoreBundle\Entity\UserPartySecret $buzzee = null)
    {
        $this->buzzee = $buzzee;

        return $this;
    }

    /**
     * Get buzzee
     *
     * @return \SecretParty\Bundle\CoreBundle\Entity\UserPartySecret 
     */
    public function getBuzzee()
    {
        return $this->buzzee;
    }
}
