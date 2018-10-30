<?php

namespace MyCompany\App\Post;

class Post
{
    /** @var string */
    public $title;

    /** @var \DateTime */
    public $publishedAt;

    public function __construct(string $title, \DateTime $publishedAt)
    {
        $this->title = $title;
        $this->publishedAt = $publishedAt;
    }
}
