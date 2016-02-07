<?php

namespace AppBundle\EventListener;

use AppBundle\Entity\Comment;
use AppBundle\Entity\Post;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PostFlushEventArgs;

class CommentListener
{
    /**
     * @var Post[]
     */
    private $updatedPosts;

    /**
     * CommentListener constructor.
     */
    public function __construct()
    {
        $this->updatedPosts = [];
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if (!$entity instanceof Comment) {
            return;
        }

        $this->updatedPosts[$entity->getPost()->getId()] = $entity->getPost();
    }

    /**
     * @param PostFlushEventArgs $args
     */
    public function postFlush(PostFlushEventArgs $args)
    {
        if (!$this->updatedPosts) {
            return;
        }

        $posts = $this->updatedPosts;
        $this->updatedPosts = [];

        foreach ($posts as $post) {
            $comments = $post->getComments();
            $sum = 0;

            foreach ($comments as $comment) {
                $sum += $comment->getRating();
            }

            $post->setRating($sum / count($comments));
        }

        $em = $args->getEntityManager();
        $em->flush($posts);
    }
}