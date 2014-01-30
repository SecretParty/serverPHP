<?php

namespace SecretParty\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * UserPartySecret
 *
 * @ORM\Table(name="secretpartycore_userpartysecret")
 * @ORM\Entity
 */
class UserPartySecret
{
    /**
     * @var Secrets
     *
     * @ORM\ManyToOne(targetEntity="Secrets")
     * @ORM\JoinColumn(name="secret_id", referencedColumnName="id")
     * @Assert\NotBlank()
     */
    private $secret;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="parties")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * @Assert\NotBlank()
     * @ORM\Id
     */
    private $user;

    /**
     * @var Party
     *
     * @ORM\ManyToOne(targetEntity="Party", inversedBy="users")
     * @ORM\JoinColumn(name="party_id", referencedColumnName="id")
     * @Assert\NotBlank()
     * @ORM\Id
     */
    private $party;

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
}
