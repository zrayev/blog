<?php

namespace AppBundle\Twig;

use AppBundle\Services\LastCommentProvider;
use AppBundle\Services\PopularPostProvider;
use AppBundle\Services\TagWeightsProvider;

class AppExtension extends \Twig_Extension
{
    /**
     * @var TagWeightsProvider
     */
    private $tagWeightsProvider;

    /**
     * @var LastCommentProvider
     */
    private $lastCommentProvider;
    /**
     * @var PopularPostProvider
     */
    private $popularPostProvider;

    /**
     * @param TagWeightsProvider $tagWeightsProvider
     * @param LastCommentProvider $lastCommentProvider
     * @param PopularPostProvider $popularPostProvider
     */
    public function __construct(TagWeightsProvider $tagWeightsProvider,
                                LastCommentProvider $lastCommentProvider,
                                PopularPostProvider $popularPostProvider
)
    {
        $this->tagWeightsProvider = $tagWeightsProvider;
        $this->lastCommentProvider = $lastCommentProvider;
        $this->popularPostProvider = $popularPostProvider;
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('get_tag_for_weights', [$this, 'getTagForWeights']),
            new \Twig_SimpleFunction('render_last_comment', [$this, 'lastComment'], [
                'is_safe' => ['html'], 'needs_environment' => true
            ]),
            new \Twig_SimpleFunction('render_popular_post', [$this, 'popularPost'], [
                'is_safe' => ['html'], 'needs_environment' => true
            ]),
        ];
    }

    /**
     * @return array
     */
    public function getTagForWeights()
    {
        return $this->tagWeightsProvider->getTags();
    }

    public function lastComment(\Twig_Environment $env)
    {
        return $env->render('@App/widgets/lastComment.html.twig', [
            'comments' => $this->lastCommentProvider->getLastComment()
        ]);
    }

    /**
     * @param \Twig_Environment $env
     * @return string
     */
    public function popularPost(\Twig_Environment $env)
    {
        return $env->render('@App/widgets/topPosts.html.twig', [
            'posts' => $this->popularPostProvider->getPopularPost()
        ]);
    }
    /**
     * @return string
     */
    public function getName()
    {
        return 'app_extension';
    }
}