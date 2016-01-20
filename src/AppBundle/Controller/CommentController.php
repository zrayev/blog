<?php

namespace AppBundle\Controller;

use AppBundle\Form\CommentType;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CommentController extends Controller
{
    /**
     * @Route("/comment", name="comment")
     * @return Response
     * @internal param Request $request
     */
    public function indexAction()
    {
        $comments = $this->getDoctrine()
            ->getRepository('AppBundle:Comment')
            ->findAll();

        return $this->render('@App/comment/index.html.twig', [
            'comments'=>$comments,
        ]);
    }

    /**
     * @Route("/comment/create", name="comment_create")
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request)
    {
//        $comment = new Comment();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(CommentType::class);
        $form->add('save', SubmitType::class, array('label' => 'Відправити'));

        if ($request->getMethod() === 'POST') {

            $form->handleRequest($request);

            if ($form->isValid()) {

                $comment = $form->getData();
               // $em = $this->getDoctrine()->getManager();
//                $slug = $this->get('app.slugger')->slugify($post->getTitle());
//                $post->setSlug($slug);
                $em->persist($comment);
//                $em->persist($slug);
                $em->flush();

//            return $this->redirectToRoute('/');
            }
        }

        return $this->render('@App/comment/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
