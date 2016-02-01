<?php

namespace AppBundle\Services;

use Symfony\Bridge\Doctrine\RegistryInterface;

class PostService
{
    protected $doctrine;
    protected $posts;
    public function __construct(RegistryInterface $doctrine, $posts)
    {
        $this->posts = $posts;
        $this->doctrine = $doctrine;
    }
    public function Posts()
    {
//        $em = $this->doctrine->getManager();
//        $posts = $em->getRepository('AppBundle:Post')->showPosts($this->posts);
         $posts = $this->doctrine->getManager()
            ->getRepository('AppBundle:Post')
            ->findAll();
        return ["posts" => $posts];
    }
}