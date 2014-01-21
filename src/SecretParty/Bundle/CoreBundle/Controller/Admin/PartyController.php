<?php

namespace SecretParty\Bundle\CoreBundle\Controller\Admin;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SecretParty\Bundle\CoreBundle\Entity\Party;

/**
 * Party controller.
 *
 * @Route("/admin/party")
 */
class PartyController extends Controller
{

    /**
     * Lists all Party entities.
     *
     * @Route("/", name="admin_party")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SecretPartyCoreBundle:Party')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Party entity.
     *
     * @Route("/{id}", name="admin_party_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SecretPartyCoreBundle:Party')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Party entity.');
        }

        return array(
            'entity'      => $entity,
        );
    }
}
