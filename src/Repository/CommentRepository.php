<?php

namespace MyCompany\App\Repository;

use MyCompany\App\Post\Post;

interface CommentRepository
{
    public function countByPost(Post $post): int;
}
