<?php

namespace SecretParty\Bundle\CoreBundle\Controller\Admin;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SecretParty\Bundle\CoreBundle\Entity\Thematic;
use SecretParty\Bundle\CoreBundle\Form\ThematicType;

/**
 * Thematic controller.
 *
 * @Route("/admin")
 */
class DefaultController extends Controller
{

    /**
     * Lists all Thematic entities.
     *
     * @Route("/", name="admin_home")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {

        return array();
    }
}
