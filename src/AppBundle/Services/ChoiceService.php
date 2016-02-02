<?php

namespace AppBundle\Services;

use Symfony\Bridge\Doctrine\RegistryInterface;

class ChoiceService
{
    protected $doctrine;
    protected $post;
    protected $id;

    public function __construct(RegistryInterface $doctrine, $post, $id)
    {
        $this->id = $id;
        $this->post = $post;
        $this->doctrine = $doctrine;
    }

    public function choicePost($id)
    {
         $post = $this->doctrine->getManager()
            ->getRepository('AppBundle:Post')
            ->find($id);
        return $post;
    }
}