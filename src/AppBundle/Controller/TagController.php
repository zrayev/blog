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
    public function tagCloudAction()
    {
        $tags = $this->getDoctrine()
            ->getRepository('AppBundle:Tag')
            ->findAll();

        return $this->render('@App/widgets/tagCloud.html.twig', [
            'tags' => $tags,
        ]);
    }

    /**
     * @Route("/tag/{slug}", name="tag_show")
     * @param $slug
     * @return Response
     */
    public function postAction($slug)
    {
        $tag = $this->getDoctrine()
            ->getRepository('AppBundle:Tag')
            ->findOneBy([
                    'slug' => $slug
                ]);
        return $this->render('@App/tag/post.html.twig',[
            'tag' => $tag,

        ]);
    }
}