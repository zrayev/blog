<?php

namespace AppBundle\Controller;

use AppBundle\Form\PostType;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\Post;

class PostController extends Controller
{
    /**
     * @Route("/post/{id}", name="post")
     * @return Response
     */
    public function indexAction($id)
    {
        $post = $this->getDoctrine()
            ->getRepository('AppBundle:Post')
            ->find($id);

        if (!$post) {
            throw $this->createNotFoundException(
                'No post found for id ' . $id
            );
        }

        return $this->render('AppBundle:post:index.html.twig', [
            'post' => $post,
        ]);
    }

    /**
     * @Route("/post/create", name="post_create")
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request)
    {
        $post = new Post();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(PostType::class, $post);
        $form->add('save', SubmitType::class, array('label' => 'Save'));

        if ($request->getMethod() === 'POST') {

            $form->handleRequest($request);

            if ($form->isValid()) {
                $em->persist($post);
                $em->flush();

            return $this->redirectToRoute('admin');
            }
        }

        return $this->render('@App/post/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/post/edit/{id}", name="post_edit")
     * @param $id
     * @param Request $request
     * @return Response
     */
    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em
            ->getRepository('AppBundle:Post')
            ->find($id);

        if (!$post) {
            throw $this->createNotFoundException(
                'No post found for id ' . $id
            );
        }

        $form = $this->createForm(PostType::class, $post);
        $form->add('save', SubmitType::class, array('label' => 'Edit'));

         if ($request->getMethod() === 'POST') {

            $form->handleRequest($request);

            if ($form->isValid()) {
                $em->flush();

            return $this->redirectToRoute('posts_refactor');
            }
        }

        return $this->render('@App/post/edit.html.twig', [
            'form' => $form->createView(),
            'post' => $post,
        ]);
    }

    /**
     * @Route("/post/delete/{id}", name="post_delete")
     * @param $id
     * @param Request $request
     * @return Response
     */
    public function deleteAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em
            ->getRepository('AppBundle:Post')
            ->find($id);

        if (!$post) {
            throw $this->createNotFoundException(
                'No post found for id ' . $id
            );
        }

        $form = $this->createForm(PostType::class, $post);
        $form->add('save', SubmitType::class, array('label' => 'Delete'));

         if ($request->getMethod() === 'POST') {

            $form->handleRequest($request);

            if ($form->isValid()) {
                $em->remove($post);
                $em->flush();

            return $this->redirectToRoute('posts_refactor');
            }
        }

        return $this->render('@App/post/delete.html.twig', [
            'form' => $form->createView(),
            'post' => $post,
        ]);
    }

    /**
     * @Route("search/post", name="post_search")
     * @param Request $request
     * @return Response
     */
    public function searchAction(Request $request)
    {
        $title = $request->query->get('title');
        $query = $this->getDoctrine()->getRepository('AppBundle:Post')->findByTitleQuery($title);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
        $query,
        $request->query->getInt('page', 1)/*page number*/,
        5/*limit per page*/
        );

        return $this->render('@App/post/search.html.twig', [
            'title' => $title,
            'pagination' => $pagination,
        ]);
    }

    /**
     * @Route("/posts/show", name="show_post")
     * @param Request $request
     * @return Response
     */
    public function loadMoreAction(Request $request)
    {
        $em    = $this->get('doctrine.orm.entity_manager');
        $dql   = "SELECT a FROM AppBundle:Post a";
        $query = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
        $query, /* query NOT result */
        $request->query->getInt('page', 1)/*page number*/,
        3/*limit per page*/
    );

    // parameters to template
    return $this->render('@App/default/more.html.twig', array('pagination' => $pagination ));
}
}