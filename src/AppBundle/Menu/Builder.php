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
        $menu->addChild('logout', array('route' => 'fos_user_security_logout'));

//        // will look for "Home" in AppBundle/Resources/translations/AppBundle.locale.yml
//$menu->addChild('Home', array('route' => 'homepage'))->setExtra('translation_domain', 'AppBundle');
//
//// will look for "Login" in Acme/AdminBundle/Resources/translations/AcmeAdminBundle.locale.yml
//$menu->addChild('Login', array('route' => 'login'))->setExtra('translation_domain', 'AcmeAdminBundle');


        return $menu;
    }
}