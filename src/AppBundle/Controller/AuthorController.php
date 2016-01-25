<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class AuthorController extends Controller
{
    /**
     * @Route("/authors", name="authors")
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
     * @Route("/authors/{id}", name="author")
     * @param $id
     * @return Response
     */
    public function postAction($id)
    {
        $author = $this->getDoctrine()
            ->getRepository('AppBundle:Author')
            ->find($id);

        return $this->render('@App/author/post.html.twig',[
            'author' => $author,

        ]);
    }
}
