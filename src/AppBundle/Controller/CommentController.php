<?php
namespace AppBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use AppBundle\Entity\Comment;
class CommentController extends Controller
{
    public function indexAction()
    {
        return [];
    }


    /**
     * @Route("/comment/last", name="last_comment")
     * @return Response
     */
    public function lastAction()
    {
        $comments = $this->getDoctrine()
            ->getRepository('AppBundle:Comment')
            ->findAll();

        return $this->render('AppBundle:comment:last.html.twig', [
            'comments' => $comments,
        ]);
    }
}