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
        $menu->addChild('menu.home', array('route' => 'index'))->setExtra('translation_domain', 'messages');
        $menu->addChild('menu.admin', array('route' => 'admin'))->setExtra('translation_domain', 'messages');
        $menu->addChild('menu.about', array('route' => 'about'))->setExtra('translation_domain', 'messages');
        $menu->addChild('menu.login', array('route' => 'fos_user_security_login'))->setExtra('translation_domain', 'messages');
        $menu->addChild('menu.logout', array('route' => 'fos_user_security_logout'))->setExtra('translation_domain', 'messages');

//        // will look for "Home" in AppBundle/Resources/translations/AppBundle.locale.yml
//$menu->addChild('Home', array('route' => 'homepage'))->setExtra('translation_domain', 'AppBundle');
//
//// will look for "Login" in Acme/AdminBundle/Resources/translations/AcmeAdminBundle.locale.yml
//$menu->addChild('Login', array('route' => 'login'))->setExtra('translation_domain', 'AcmeAdminBundle');


        return $menu;
    }
}