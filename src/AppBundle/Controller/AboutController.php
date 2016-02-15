<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AboutController extends Controller
{
    /**
     * @Route("/{_locale}/about", name="about")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
          return $this->render('@App/about.html.twig');
    }

}
