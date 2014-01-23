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
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations\Post;
use SecretParty\Bundle\CoreBundle\Entity\Party;
use SecretParty\Bundle\CoreBundle\Entity\User;

/**
 * Party API controller.
 *
 */
class PartyApiController extends FOSRestController
{

    /**
     * Create a new party
     * @ApiDoc(
     *  resource=true,
     *  description="Create a new party"
     * )
     * @Post("/party")
     */
    public function postPartyAction(Request $request)
    {
        $name_party = $request->request->get('name_party');
        $length_party = $request->request->get('length_party');
        $thematic_party = $request->request->get('thematic_party');
        $name_user = $request->request->get('name_user');
        $secret_user = $request->request->get('secret_user');
        
        $em = $this->getDoctrine()->getManager();

        $thematic_party = $em->getRepository("SecretPartyCoreBundle:Thematic")->find($thematic_party);
        if(!$thematic_party)
        {
            throw new HttpException(400, 'Thematic id is not valid');
        }

        $secret_user = $em->getRepository("SecretPartyCoreBundle:Secrets")->find($secret_user);
        if(!$secret_user)
        {
            throw new HttpException(400, 'User secret id is not valid');
        }

        $party = new Party();
        $party->setName($name_party);
        $party->setLength($length_party);
        $party->setThematic($thematic_party);
        $party->setDate(new \DateTime());

        $user = new User();
        $user->setName($name_user);
        $user->setSecret($secret_user);
        $user->setParty($party);
        
        $party->addUser($user);
        
        $em->persist($party);
        $em->persist($user);
        $em->flush();

        return $this->handleView($this->view($party));
    }

}
