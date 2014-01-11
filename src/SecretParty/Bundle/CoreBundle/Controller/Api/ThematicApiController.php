<?php

namespace SecretParty\Bundle\CoreBundle\Controller\Api;

use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
/**
 * Thematic controller.
 *
 */
class ThematicApiController extends FOSRestController
{

    /**
     * Lists all Thematic entities.
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Lists all Thematic entities."
     * )
     */
    public function getThematicsAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SecretPartyCoreBundle:Thematic')->findAll();

        return $this->handleView($this->view($entities));
    }
}
