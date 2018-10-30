<?php

namespace MyCompany\App\Post;

use MyCompany\App\Repository\CommentRepository;
use MyCompany\App\Repository\PostRepository;

final class GetPostsList
{
    /** @var PostRepository */
    private $postRepository;

    /** @var CommentRepository */
    private $commentRepository;

    /** @var \DateTime */
    private $now;

    public function __construct(PostRepository $postRepository, CommentRepository $commentRepository, \DateTime $now)
    {
        $this->postRepository = $postRepository;
        $this->commentRepository = $commentRepository;
        $this->now = $now;
    }

    public function __invoke(): array
    {
        $postViews = [];

        foreach ($this->postRepository->getAll() as $post) {
            $isLessThanAWeekOld = (clone $post->publishedAt)->add(new \DateInterval('P1W')) > $this->now;

            $postViews[] = new PostView(
                $post->title,
                $this->commentRepository->countByPost($post),
                $isLessThanAWeekOld
            );
        }

        return $postViews;
    }
}
