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

namespace SecretParty\Bundle\CoreBundle\Controller\Api;

use FOS\RestBundle\Util\Codes;
use SecretParty\Bundle\CoreBundle\Event\JoinUserEvent;
use SecretParty\Bundle\CoreBundle\Exception\PartyLogicalException;
use SecretParty\Bundle\CoreBundle\Form\JoinUserType;
use SecretParty\Bundle\CoreBundle\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use SecretParty\Bundle\CoreBundle\Entity\User;
use FOS\RestBundle\Controller\Annotations\Post;
use JMS\Serializer\SerializationContext;
use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * User API controller.
 *
 */
class UserApiController extends FOSRestController
{
    /**
     * @ApiDoc(
     *  description="Create a new user",
     *  output={
     *   "class"="SecretParty\Bundle\CoreBundle\Entity\User",
     *   "groups"={"user"}
     * }
     * )
     * @Rest\Get("/user/{id}")
     * @Rest\View
     */
    public function getUserAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SecretPartyCoreBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        return $this->view($entity)->setSerializationContext(SerializationContext::create()->setGroups(array('user')));
    }

    /**
     * Create a new user
     * @ApiDoc(
     *  description="Create a new user",
     *  input="SecretParty\Bundle\CoreBundle\Form\UserType",
     *  output={
     *   "class"="SecretParty\Bundle\CoreBundle\Entity\User",
     *   "groups"={"user"}
     * }
     * )
     * @Rest\Post("/user")
     * @Rest\View
     */
    public function postUserAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(new UserType(),$user);
        $form->handleRequest($request);

        if($form->isValid()){

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $view = $this->view($user);
            $view->setSerializationContext(SerializationContext::create()->setGroups(array('user')));
            return $view;

        }
        return $this->view($form,Codes::HTTP_BAD_REQUEST);
    }

    /**
     * Update a new user
     * @ApiDoc(
     *  input="SecretParty\Bundle\CoreBundle\Form\UserType",
     *  output={
     *   "class"="SecretParty\Bundle\CoreBundle\Entity\User",
     *   "groups"={"user"}
     * }
     * )
     * @Rest\Put("/user/{id}")
     * @Rest\View
     */
    public function putUserAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('SecretPartyCoreBundle:User')->find($id);

        if (!$user) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $form = $this->createForm(new UserType(),$user);
        $form->handleRequest($request);

        if($form->isValid()){

            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $view = $this->view($user);
            $view->setSerializationContext(SerializationContext::create()->setGroups(array('user')));
            return $view;

        }
        return $this->view($form,Codes::HTTP_BAD_REQUEST);
    }

    /**
     * Delete user
     * @ApiDoc()
     * @Rest\Delete("/user/{id}")
     * @Rest\View
     */
    public function deleteUserAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SecretPartyCoreBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $em->remove($entity);
        $em->flush();

        return $this->view(null,Codes::HTTP_NO_CONTENT);
    }

}
