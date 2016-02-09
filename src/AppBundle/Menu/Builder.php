<?php

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->addChild('Головна', array('route' => 'index'));
        $menu->addChild('Адміністрування', array('route' => 'admin'));
        $menu->addChild('Про автора', array('route' => 'about'));
        $menu->addChild('login', array('route' => 'fos_user_security_login'));

        return $menu;
    }
}