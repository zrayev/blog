<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class AdminController extends Controller
{
    /**
     * @Route("/{_locale}/admin", name="admin")
     * @return Response
     */
    public function indexAction()
    {
        return $this->render('@App/admin/index.html.twig');
    }

    /**
     * @Route("/{_locale}/post/refactor", name="posts_refactor")
     * @return Response
     */
    public function refactorAction()
    {
        $posts = $this->getDoctrine()
            ->getRepository('AppBundle:Post')
            ->findAll()
        ;

        return $this->render('@App/admin/posts_refactor.html.twig', [
            'posts'=>$posts,
        ]);
    }
}
