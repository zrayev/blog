<?php

namespace AppBundle\Services;

use Doctrine\ORM\EntityManagerInterface;

class LastCommentProvider
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
    public function getLastComment()
    {
        $comments = $this->em
            ->getRepository('AppBundle:Comment')
            ->findLastComment()
        ;

        return $comments;
    }
}
