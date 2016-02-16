<?php

namespace AppBundle\Services;

use Doctrine\ORM\EntityManagerInterface;

class TagWeightsProvider
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
    public function getTags()
    {
        $tags = $this->em
            ->getRepository('AppBundle:Tag')
            ->findAll()
        ;
        $tagStatistic = [];

        foreach ($tags as $tag) {
            $tagStatistic[$tag->getName()] = [
                'count' => count($tag->getPosts()),
                'slug' => $tag->getSlug(),
            ];
        }

        return $tagStatistic;
    }
}
