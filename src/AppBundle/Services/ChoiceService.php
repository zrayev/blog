<?php

namespace AppBundle\Services;

use Symfony\Bridge\Doctrine\RegistryInterface;

class ChoiceService
{
    protected $doctrine;
    protected $post;
    protected $slug;

    /**
     * ChoiceService constructor.
     * @param RegistryInterface $doctrine
     * @param $post
     * @param $slug
     */
    public function __construct(RegistryInterface $doctrine, $post, $slug)
    {
        $this->slug = $slug;
        $this->post = $post;
        $this->doctrine = $doctrine;
    }

    /**
     * @param $slug
     * @return \AppBundle\Entity\Post|null|object
     */
    public function choicePost($slug)
    {
         $post = $this->doctrine->getManager()
            ->getRepository('AppBundle:Post')
            ->findOneBy(
                [
                    'slug' => $slug,
                ]
            );
        return $post;
    }
}