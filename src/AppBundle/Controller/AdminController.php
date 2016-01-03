<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{
    /**
     * @return Response
     */
    public function indexAction()
    {
        return $this->render('AppBundle:admin:index.html.twig');
    }
}
