<?php

namespace MyCompany\App\Repository;

use MyCompany\App\Post\Post;

interface PostRepository
{
    /**
     * @return Post[]
     */
    public function getAll(): array;
}
