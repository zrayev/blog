<?php

namespace AppBundle\Controller;

use AppBundle\Form\PostType;
use AppBundle\Form\CommentType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\Post;
use AppBundle\Entity\Comment;

class PostController extends Controller
{
    /**
     * @Route("/post/{slug}", name="post")
     * @param Request $request
     * @param Post $post
     * @return Response
     */
    public function indexAction(Request $request, Post $post)
    {
        $em = $this->getDoctrine()->getManager();

        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->add('Відправити', SubmitType::class);
        $form->handlerequest($request);

        if ($form->isValid()) {
            $post->addComment($comment);
            $comment->setPost($post);
            $em->persist($comment);
            $em->persist($post);
            $em->flush();

             return $this->redirectToRoute('post', [
                'slug' =>$post->getSlug(),
            ]);
        }

       return $this->render('@App/post/index.html.twig', [
            'post' => $post,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/post/create/", name="post_create")
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
     * @Route("/post/edit/{slug}", name="post_edit")
     * @param $slug
     * @param Request $request
     * @return Response
     */
    public function editAction($slug, Request $request)
    {
        $choiceService = $this->container->get('app.choice_post');
        $post = $choiceService-> choicePost($slug);

        if (!$post) {
            throw $this->createNotFoundException(
                'Unable to find Post..'
            );
        }

        $em = $this->getDoctrine()->getManager();
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
     * @Route("/post/delete/{slug}", name="post_delete")
     * @param $slug
     * @param Request $request
     * @return Response
     */
    public function deleteAction($slug, Request $request)
    {
        $choiceService = $this->container->get('app.choice_post');
        $post = $choiceService-> choicePost($slug);

        if (!$post) {
            throw $this->createNotFoundException(
                'Unable to find Post..'
            );
        }
        $em = $this->getDoctrine()->getManager();
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
        $paginationService = $this->container->get('app.pagination_search_query');
        $pagination = $paginationService->paginationSearchQuery($request);

        return $this->render('@App/post/search.html.twig', [
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
        $paginationService = $this->container->get('app.pagination_load_more_query');
        $pagination = $paginationService->paginationLoadMoreQuery($request);

        return $this->render('@App/default/more.html.twig', [
            'pagination' => $pagination,
        ]);
    }
}