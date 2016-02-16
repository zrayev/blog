<?php

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function anonMenu(FactoryInterface $factory)
    {
        $menu = $factory->createItem('root');
        $menu->addChild('menu.home', array('route' => 'index'))->setExtra('translation_domain', 'messages');
        $menu->addChild('menu.about', array('route' => 'about'))->setExtra('translation_domain', 'messages');
        $menu->addChild('menu.login', array('route' => 'fos_user_security_login'))->setExtra('translation_domain', 'messages');

        return $menu;
    }

    public function userMenu(FactoryInterface $factory)
    {
        $menu = $factory->createItem('root');
        $menu->addChild('menu.home', array('route' => 'index'))->setExtra('translation_domain', 'messages');
        $menu->addChild('menu.admin', array('route' => 'admin'))->setExtra('translation_domain', 'messages');
        $menu->addChild('menu.about', array('route' => 'about'))->setExtra('translation_domain', 'messages');
        $menu->addChild('menu.logout', array('route' => 'fos_user_security_logout'))->setExtra('translation_domain', 'messages');

        return $menu;
    }
}