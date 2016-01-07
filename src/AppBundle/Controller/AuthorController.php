<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class AuthorController extends Controller
{
    public function indexAction()
    {
        $authors = $this->getDoctrine()
            ->getRepository('AppBundle:Author')
            ->findAll();

        return $this->render('@App/author/index.html.twig',[
            'authors' => $authors,
        ]);
    }

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
