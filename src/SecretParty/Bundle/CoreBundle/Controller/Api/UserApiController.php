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

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use SecretParty\Bundle\CoreBundle\Entity\User;
use FOS\RestBundle\Controller\Annotations\Post;

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
     *  parameters={
     *      {"name"="id_secret", "dataType"="int", "required"=true},
     *      {"name"="id_party", "dataType"="int", "required"=true},
     *      {"name"="name_user", "dataType"="string", "required"=true}
     *  }
     * )
     * @Post("/user")
     */
    public function postUserAction(Request $request)
    {
        $secret = $request->request->get('id_secret');
        $party = $request->request->get('id_party');
        $name = $request->request->get('name_user');

        $em = $this->getDoctrine()->getManager();

        $secret = $em->getRepository("SecretPartyCoreBundle:Secrets")->find($secret);
        if(!$secret)
        {
            throw new HttpException(400, 'Secret id is not valid');
        }

        $party = $em->getRepository("SecretPartyCoreBundle:Party")->find($party);
        if(!$party)
        {
            throw new HttpException(400, 'Party id is not valid');
        }

        $user = new User();
        $user->setName($name);
        $user->setSecret($secret);
        $user->setParty($party);
        $em->persist($user);
        $em->flush();

        return $this->handleView($this->view($user));
    }

}
