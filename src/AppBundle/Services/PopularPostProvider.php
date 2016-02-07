<?php

namespace AppBundle\Services;

use Doctrine\ORM\EntityManagerInterface;

class PopularPostProvider
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }


    /**
     * @return array
     */
    public function getPopularPost()
    {
        $posts = $this->em
            ->getRepository('AppBundle:Post')
            ->findPopularPost()
        ;

        return $posts;
    }
}
