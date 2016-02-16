<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class AuthorController extends Controller
{
    /**
     * @Route("/{_locale}/authors", name="authors")
     * @return Response
     */
    public function indexAction()
    {
        $authors = $this->getDoctrine()
            ->getRepository('AppBundle:Author')
            ->findAll();

        return $this->render('@App/author/index.html.twig',[
            'authors' => $authors,
        ]);
    }

    /**
     * @Route("/{_locale}/author/{slug}", name="author")
     * @param $slug
     * @return Response
     */
    public function postAction($slug)
    {
        $author = $this->getDoctrine()
            ->getRepository('AppBundle:Author')
            ->findOneBy([
                    'slug' => $slug
                ]);
        return $this->render('@App/author/post.html.twig',[
            'author' => $author,

        ]);
    }
}
