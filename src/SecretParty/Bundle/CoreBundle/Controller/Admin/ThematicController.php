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
 * @Route("/admin/thematic")
 */
class ThematicController extends Controller
{

    /**
     * Lists all Thematic entities.
     *
     * @Route("/", name="admin_thematic")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SecretPartyCoreBundle:Thematic')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Thematic entity.
     *
     * @Route("/", name="admin_thematic_create")
     * @Method("POST")
     * @Template("SecretPartyCoreBundle:Admin/Thematic:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Thematic();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            foreach($entity->getSecrets() as $secret){
                $secret->setThematic($entity);
                $em->persist($secret);
            }
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_thematic_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Thematic entity.
    *
    * @param Thematic $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Thematic $entity)
    {
        $form = $this->createForm(new ThematicType(), $entity, array(
            'action' => $this->generateUrl('admin_thematic_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Thematic entity.
     *
     * @Route("/new", name="admin_thematic_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Thematic();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Thematic entity.
     *
     * @Route("/{id}", name="admin_thematic_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SecretPartyCoreBundle:Thematic')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Thematic entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Thematic entity.
     *
     * @Route("/{id}/edit", name="admin_thematic_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SecretPartyCoreBundle:Thematic')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Thematic entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Thematic entity.
    *
    * @param Thematic $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Thematic $entity)
    {
        $form = $this->createForm(new ThematicType(), $entity, array(
            'action' => $this->generateUrl('admin_thematic_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Thematic entity.
     *
     * @Route("/{id}", name="admin_thematic_update")
     * @Method("PUT")
     * @Template("SecretPartyCoreBundle:Admin/Thematic:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SecretPartyCoreBundle:Thematic')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Thematic entity.');
        }

        $originalSecrets = new ArrayCollection();
        foreach ($entity->getSecrets() as $secret) {
            $originalSecrets->add($secret);
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            // add for new secret
            foreach($entity->getSecrets() as $secret){
                $secret->setThematic($entity);
                $em->persist($secret);
            }

            // remove the relationship between the secret and the thematic
            foreach ($originalSecrets as $secret) {
                if (false === $entity->getSecrets()->contains($secret)) {
                    $secret->setThematic(null);
                    $em->remove($secret);
                }
            }

            $em->flush();

            return $this->redirect($this->generateUrl('admin_thematic_show', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Thematic entity.
     *
     * @Route("/{id}", name="admin_thematic_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SecretPartyCoreBundle:Thematic')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Thematic entity.');
            }

            foreach($entity->getSecrets() as $secret){
                $em->remove($secret);
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_thematic'));
    }

    /**
     * Creates a form to delete a Thematic entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_thematic_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
