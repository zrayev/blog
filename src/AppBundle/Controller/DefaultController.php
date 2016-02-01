<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="index")
     * @return Response
     * @internal param Request $request
     */
    public function indexAction()
    {
        $postService = $this->container->get('app.posts');
        $posts = $postService-> Posts();
        
        return $this->render('AppBundle:default:index.html.twig', [
            'posts'=>$posts,
        ]);
    }
}
