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
use SecretParty\Bundle\CoreBundle\Entity\Buzz;
use SecretParty\Bundle\CoreBundle\Entity\PartyUser;
use SecretParty\Bundle\CoreBundle\Entity\UserPartySecret;
use SecretParty\Bundle\CoreBundle\Event\BuzzEvent;
use SecretParty\Bundle\CoreBundle\Event\JoinUserEvent;
use SecretParty\Bundle\CoreBundle\Exception\PartyLogicalException;
use SecretParty\Bundle\CoreBundle\Form\BuzzType;
use SecretParty\Bundle\CoreBundle\Form\JoinUserType;
use SecretParty\Bundle\CoreBundle\Form\PartyType;
use SecretParty\Bundle\CoreBundle\Form\PartyUserType;
use SecretParty\Bundle\CoreBundle\Form\UserPartySecretType;
use SecretParty\Bundle\CoreBundle\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations as Rest;
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
     * Lists all current Party entities.
     *
     * @ApiDoc(
     *  output={
     *   "class"="SecretParty\Bundle\CoreBundle\Entity\Party",
     *   "groups"={"party"},
     * },
     *  filters={
     *      {"name"="thematic", "dataType"="integer"},
     *
     *  }
     * )
     * @Rest\Get("/parties")
     * @Rest\View()
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SecretPartyCoreBundle:Party')->findAllNotFinish($request->query->get("thematic",null));

        return $this->view($entities)->setSerializationContext(SerializationContext::create()->setGroups(array('party')));
    }

    /**
     * Create a new party and user
     * @ApiDoc(
     *  description="Create a new party",
     *  input="SecretParty\Bundle\CoreBundle\Form\PartyUserType",
     *  output={
     *   "class"="SecretParty\Bundle\CoreBundle\Entity\Party",
     *   "groups"={"party"}
     * }
     * )
     * @Rest\Post("/party")
     * @Rest\View
     */
    public function postPartyAction(Request $request)
    {
        $partyUser = new PartyUser();
        $form = $this->createForm(new PartyUserType(),$partyUser);
        $form->handleRequest($request);

        if($form->isValid()){
            $user = $partyUser->getUser();
            $party = $partyUser->getParty();
            $party->setDate(new \DateTime());

            $em = $this->getDoctrine()->getManager();

            $em->persist($party);
            $em->flush();

            $userPartySecret = new UserPartySecret();
            $userPartySecret->setParty($party);
            $userPartySecret->setSecret($partyUser->getSecret());
            $userPartySecret->setUser($user);
            $party->addUser($userPartySecret);
            $user->addParty($userPartySecret);
            $em->persist($userPartySecret);
            $em->flush();

            $view = $this->view($partyUser->getParty());
            $view->setSerializationContext(SerializationContext::create()->setGroups(array('party')));
            return $view;

        }
        return $this->view($form,Codes::HTTP_BAD_REQUEST);
    }

    /**
     * Get party informations
     * @ApiDoc(
     *  description="Get informations about a party",
     *  output={
     *   "class"="SecretParty\Bundle\CoreBundle\Entity\Party",
     *   "groups"={"party"}
     * }
     * )
     * @Rest\Get("/party/{id}")
     * @Rest\View
     */
    public function getPartyAction($id)
    {
        $view = $this->view($this->getParty($id));
        $view->setSerializationContext(SerializationContext::create()->setGroups(array('party')));
        return $view;
    }

    /**
     * Create a new user
     * @ApiDoc(
     *  description="Join a new user",
     *  input="SecretParty\Bundle\CoreBundle\Form\UserPartySecretType",
     *  output={
     *   "class"="SecretParty\Bundle\CoreBundle\Entity\Party",
     *   "groups"={"party"}
     * }
     * )
     * @Rest\Post("/party/{id}/join")
     * @Rest\View
     */
    public function postUserAction(Request $request,$id)
    {
        $party = $this->getParty($id);

        $userPartySecret = new UserPartySecret();
        $userPartySecret->setParty($party);
        $form = $this->createForm(new UserPartySecretType(),$userPartySecret);
        $form->handleRequest($request);

        if($form->isValid()){
            try{

                $event = new JoinUserEvent($party);
                $this->get('event_dispatcher')->dispatch('secret_party_core.event.join_user',$event);

                $em = $this->getDoctrine()->getManager();
                $em->persist($userPartySecret);
                $em->flush();

                $view = $this->view($party);
                $view->setSerializationContext(SerializationContext::create()->setGroups(array('party')));
                return $view;
            }
            catch(PartyLogicalException $e){
                return $this->view(array("code" => Codes::HTTP_BAD_REQUEST, "message" => $e->getMessage()),Codes::HTTP_BAD_REQUEST);
            }
        }
        return $this->view($form,Codes::HTTP_BAD_REQUEST);
    }


    /**
     * Buzz user
     * @ApiDoc(
     *  description="Buzz user",
     *  input="SecretParty\Bundle\CoreBundle\Form\BuzzType"
     * )
     * @Rest\Post("/party/{id}/buzz")
     * @Rest\View
     */
    public function buzzAction(Request $request,$id)
    {
        $party = $this->getParty($id);

        $form = $this->createForm(new BuzzType());
        $form->handleRequest($request);

        if($form->isValid()){
            $data = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $buzzer = $this->getUserPartySecret($data['buzzer'],$party);
            $buzzee = $this->getUserPartySecret($data['buzzee'],$party);

            $buzz = new Buzz();
            $buzz->setBuzzer($buzzer);
            $buzz->setBuzzee($buzzee);
            $buzz->setSecret($data["secret"]);
            $buzz->setDate(new \DateTime());

            $event = new BuzzEvent($buzz);
            $this->get('event_dispatcher')->dispatch('secret_party_core.event.buzz',$event);

            $em->persist($buzz);
            $em->flush();

            return $this->view();
        }
        return $this->view($form,Codes::HTTP_BAD_REQUEST);
    }

    /**
     * @param $id
     * @return Party
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    private function getParty($id)
    {
        $em = $this->getDoctrine()->getManager();
        $party = $em->getRepository("SecretPartyCoreBundle:Party")->find($id);
        if (!$party) {

            throw $this->createNotFoundException('Unable to find Party entity.');
        }
        if($party->getTimestamp()+$party->getLength() < time()){

        }
        else
            return $party;
    }

    /**
     * @param $user
     * @param $party
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @internal param $id
     * @return Party
     */
    private function getUserPartySecret($user,$party)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository("SecretPartyCoreBundle:UserPartySecret")->findOneBy(array("user"=> $user,"party"=>$party));
        if (!$entity) {

            throw $this->createNotFoundException('Unable to find User entity in Party.');
        }
        return $entity;
    }

}
