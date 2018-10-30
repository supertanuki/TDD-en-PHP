<?php

namespace MyCompany\App\Tests\Post;

use MyCompany\App\Post\GetPostsList;
use MyCompany\App\Post\Post;
use MyCompany\App\Post\PostView;
use MyCompany\App\Repository\CommentRepository;
use MyCompany\App\Repository\PostRepository;
use PHPUnit\Framework\TestCase;

class GetPostsListTest extends TestCase
{
    public function test_get_new_and_old_posts()
    {
        $now = new \DateTime('2018-10-30');
        $post1 = new Post('TDD c\'est bien', new \DateTime('2018-10-29'));
        $post2 = new Post('Tester c\'est douter', new \DateTime('2018-10-01'));

        $postRepository = $this->prophesize(PostRepository::class);
        $postRepository->getAll()->shouldBeCalled()->willReturn([$post1, $post2]);

        $commentRepository = $this->prophesize(CommentRepository::class);
        $commentRepository->countByPost($post1)->shouldBeCalled()->willReturn(42);
        $commentRepository->countByPost($post2)->shouldBeCalled()->willReturn(1);

        $getPostsList = new GetPostsList($postRepository->reveal(), $commentRepository->reveal(), $now);

        $this->assertEquals(
            [
                new PostView('TDD c\'est bien', 42, true),
                new PostView('Tester c\'est douter', 1, false),
            ],
            $getPostsList()
        );
    }
}
