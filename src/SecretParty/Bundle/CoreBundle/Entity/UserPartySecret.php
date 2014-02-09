<?php

namespace SecretParty\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as JMS;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * UserPartySecret
 *
 * @ORM\Table(name="secretpartycore_userpartysecret")
 * @ORM\Entity
 * @UniqueEntity({"user","party"})
 */
class UserPartySecret
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
     * @var Secrets
     *
     * @ORM\ManyToOne(targetEntity="Secrets")
     * @ORM\JoinColumn(name="secret_id", referencedColumnName="id")
     * @Assert\NotBlank()
     * @JMS\Groups({"resultat"})
     */
    private $secret;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="parties")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * @Assert\NotBlank()
     * @JMS\Groups({"party"})
     */
    private $user;

    /**
     * @var Party
     *
     * @ORM\ManyToOne(targetEntity="Party", inversedBy="users")
     * @ORM\JoinColumn(name="party_id", referencedColumnName="id")
     * @Assert\NotBlank()
     */
    private $party;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Buzz", mappedBy="buzzee")
     * @JMS\Groups({"resultat"})
     */
    private $buzzers;

    /**
     * Set secret
     *
     * @param \SecretParty\Bundle\CoreBundle\Entity\Secrets $secret
     * @return UserPartySecret
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
     * Set user
     *
     * @param \SecretParty\Bundle\CoreBundle\Entity\User $user
     * @return UserPartySecret
     */
    public function setUser(\SecretParty\Bundle\CoreBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \SecretParty\Bundle\CoreBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set party
     *
     * @param \SecretParty\Bundle\CoreBundle\Entity\Party $party
     * @return UserPartySecret
     */
    public function setParty(\SecretParty\Bundle\CoreBundle\Entity\Party $party)
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
     * Constructor
     */
    public function __construct()
    {
        $this->buzzers = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add buzzers
     *
     * @param \SecretParty\Bundle\CoreBundle\Entity\Buzz $buzzers
     * @return UserPartySecret
     */
    public function addBuzzer(\SecretParty\Bundle\CoreBundle\Entity\Buzz $buzzers)
    {
        $this->buzzers[] = $buzzers;

        return $this;
    }

    /**
     * Remove buzzers
     *
     * @param \SecretParty\Bundle\CoreBundle\Entity\Buzz $buzzers
     */
    public function removeBuzzer(\SecretParty\Bundle\CoreBundle\Entity\Buzz $buzzers)
    {
        $this->buzzers->removeElement($buzzers);
    }

    /**
     * Get buzzers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBuzzers()
    {
        return $this->buzzers;
    }
}
