<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin")
     * @return Response
     */
    public function indexAction()
    {
        return $this->render('@App/admin/index.html.twig');
    }

    /**
     * @Route("/post/refactor", name="posts_refactor")
     * @return Response
     */
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
