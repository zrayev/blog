<?php

namespace AppBundle\Controller;

use AppBundle\Form\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\Post;

class PostController extends Controller
{
    /**
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
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request)
    {
//        $post = new Post();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(PostType::class);
        $form->add('save', SubmitType::class, array('label' => 'Save'));

        if ($request->getMethod() === 'POST') {

            $form->handleRequest($request);

            if ($form->isValid()) {

                $post = $form->getData();
               // $em = $this->getDoctrine()->getManager();
                $slug = $this->get('app.slugger')->slugify($post->getTitle());
                $post->setSlug($slug);
                $em->persist($post);
//                $em->persist($slug);
                $em->flush();

            return $this->redirectToRoute('admin');
            }
        }

        return $this->render('@App/post/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
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

    public function searchAction(Request $request)
    {
        $title = $request->query->get('title');
        $this->getDoctrine()->getRepository('AppBundle:Post')->findByTitleQuery($title);


//
//                $name = $request->query->get('name');
//        $paginator  = $this->get('knp_paginator');
//        $pagination = $paginator->paginate(
//        $this->getDoctrine()->getRepository('AppBundle:Player')->findByNameQuery($name), /* query NOT result */
//        $request->query->getInt('page', 1)/*page number*/,
//        5/*limit per page*/
//        );
//


        return $this->render('@App/post/search.html.twig', [
            'title' => $title,
        ]);
    }
}