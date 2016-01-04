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
        return $this->render('@App/admin/index.html.twig');
    }

    public function refactorAction()
    {
    $posts = $this->getDoctrine()
        ->getRepository('AppBundle:Post')
        ->findAll();

        return $this->render('@App/admin/posts_refactor.html.twig', [
            'posts'=>$posts,
        ]);
    }
}
