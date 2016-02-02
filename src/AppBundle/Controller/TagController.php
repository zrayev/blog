<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Tag;

class TagController extends Controller
{
    /**
     * @Route("/tags", name="tags")
     * @return Response
     */
    public function indexAction()
    {
        $tags = $this->getDoctrine()
            ->getRepository('AppBundle:Tag')
            ->findAll();

        return $this->render('@App/tag/index.html.twig', [
            'tags' => $tags,
        ]);
    }
}