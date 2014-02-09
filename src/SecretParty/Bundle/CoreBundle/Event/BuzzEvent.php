<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 25/01/2014
 * Time: 16:04
 */

namespace SecretParty\Bundle\CoreBundle\Event;


use SecretParty\Bundle\CoreBundle\Entity\Buzz;
use Symfony\Component\EventDispatcher\Event;

class BuzzEvent extends Event{


    /**
     * @var \SecretParty\Bundle\CoreBundle\Entity\Buzz
     */
    protected $buzz;

    function __construct( Buzz $buzz)
    {
        $this->buzz = $buzz;
    }

    /**
     * @return \SecretParty\Bundle\CoreBundle\Entity\Buzz
     */
    public function getBuzz()
    {
        return $this->buzz;
    }



} 