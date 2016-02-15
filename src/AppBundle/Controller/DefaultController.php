<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/{_locale}/", name="index")
     * @return Response
     * @internal param Request $request
     */
    public function indexAction(Request $request)
    {
        $postService = $this->container->get('app.show_posts');
        $posts = $postService-> showPosts();
//        $request->setLocale('uk');

        return $this->render('AppBundle:default:index.html.twig', [
            'posts'=>$posts,
        ]);
    }
}
