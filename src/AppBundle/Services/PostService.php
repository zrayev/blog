<?php

namespace AppBundle\Services;

use Symfony\Bridge\Doctrine\RegistryInterface;

class PostService
{
    protected $doctrine;
    protected $posts;

    /**
     * PostService constructor.
     * @param RegistryInterface $doctrine
     * @param $posts
     */
    public function __construct(RegistryInterface $doctrine, $posts)
    {
        $this->posts = $posts;
        $this->doctrine = $doctrine;
    }

    /**
     * @return array
     */
    public function showPosts()
    {
         $posts = $this->doctrine->getManager()
            ->getRepository('AppBundle:Post')
            ->findAll();
        return ["posts" => $posts];
    }
}