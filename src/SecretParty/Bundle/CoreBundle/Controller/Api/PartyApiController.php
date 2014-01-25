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

use SecretParty\Bundle\CoreBundle\Entity\PartyUser;
use SecretParty\Bundle\CoreBundle\Form\PartyType;
use SecretParty\Bundle\CoreBundle\Form\PartyUserType;
use SecretParty\Bundle\CoreBundle\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Get;
use SecretParty\Bundle\CoreBundle\Entity\Party;
use SecretParty\Bundle\CoreBundle\Entity\User;
use JMS\Serializer\SerializationContext;

/**
 * Party API controller.
 *
 */
class PartyApiController extends FOSRestController
{

    /**
     * Create a new party and user
     * @ApiDoc(
     *  description="Create a new party",
     *  input="SecretParty\Bundle\CoreBundle\Form\PartyUserType"
     * )
     * @Post("/party")
     */
    public function postPartyAction(Request $request)
    {
        $partyUser = new PartyUser();
        $form = $this->createForm(new PartyUserType(),$partyUser);
        $form->handleRequest($request);

        if($form->isValid()){
            $partyUser->getParty()->addUser($partyUser->getUser());
            $partyUser->getParty()->setDate(new \DateTime());
            $partyUser->getUser()->setParty($partyUser->getParty());

            $em = $this->getDoctrine()->getManager();
            $em->persist($partyUser->getParty());
            $em->persist($partyUser->getUser());
            $em->flush();

            $view = $this->view($partyUser->getParty());
            $view->setSerializationContext(SerializationContext::create()->setGroups(array('party')));
            return $this->handleView($view);

        }
        return $this->handleView($this->view($form,400));
    }

    /**
     * Get party informations
     * @ApiDoc(
     *  description="Get informations about a party"
     * )
     * @Get("/party/{id}")
     */
    public function getPartyAction($id)
    {
        
        $em = $this->getDoctrine()->getManager();
        $party = $em->getRepository("SecretPartyCoreBundle:Party")->find($id);
        if(!$party)
        {
            throw new \HttpException(400, 'Party id is not valid');
        }


        $view = $this->view($party);
        $view->setSerializationContext(SerializationContext::create()->setGroups(array('party')));
        return $this->handleView($view);
    }

}
