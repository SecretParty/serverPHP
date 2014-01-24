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

use SecretParty\Bundle\CoreBundle\Form\JoinUserType;
use SecretParty\Bundle\CoreBundle\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use SecretParty\Bundle\CoreBundle\Entity\User;
use FOS\RestBundle\Controller\Annotations\Post;
use JMS\Serializer\SerializationContext;

/**
 * User API controller.
 *
 */
class UserApiController extends FOSRestController
{

    /**
     * Create a new user
     * @ApiDoc(
     *  resource=true,
     *  description="Create a new user",
     *  input="SecretParty\Bundle\CoreBundle\Form\JoinUserType"
     * )
     * @Post("/user")
     */
    public function postUserAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(new JoinUserType(),$user);
        $form->handleRequest($request);


        if($form->isValid()){

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $view = $this->view($user);
            $view->setSerializationContext(SerializationContext::create()->setGroups(array('user')));
            return $this->handleView($view);
        }
        return $this->view($form,400);
    }

}
