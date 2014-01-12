<?php
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

        $menu->addChild('Thematic', array());
        $menu['Thematic']->addChild('New Thematic', array('route' => 'admin_thematic_new','attributes'=>array('class'=>'icn_new_article')));
        $menu['Thematic']->addChild('List Thematic', array('route' => 'admin_thematic','attributes'=>array('class'=>'icn_categories')));
        return $menu;
    }
}