<?php

namespace AppBundle\Repository;
use AppBundle\Entity\Comment;

/**
 * CommentRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CommentRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * @return Comment[]
     */
    public function findLastComment()
    {
        return $this->createQueryBuilder('c')
            ->orderBy('c.created', 'DESC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult()
        ;
    }
}
