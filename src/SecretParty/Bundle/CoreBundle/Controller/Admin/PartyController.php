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
