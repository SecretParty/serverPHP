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

namespace SecretParty\Bundle\CoreBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\Request;

class MenuBuilder
{
    private $factory;

    /**
     * @param FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function createMainMenu(Request $request)
    {
        $menu = $this->factory->createItem('root');

        $menu->addChild('Thematics and secrets', array());
        $menu['Thematics and secrets']->addChild('New Thematic', array('route' => 'admin_thematic_new','attributes'=>array('class'=>'icn_new_article')));
        $menu['Thematics and secrets']->addChild('List Thematic', array('route' => 'admin_thematic','attributes'=>array('class'=>'icn_categories')));
         $menu->addChild('Parties', array());
        $menu['Parties']->addChild('List Parties', array('route' => 'admin_party','attributes'=>array('class'=>'icn_categories')));
        return $menu;
    }
}