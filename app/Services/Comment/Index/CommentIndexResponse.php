<?php

namespace App\Services\Comment\Index;

class CommentIndexResponse {

    private array $comments;

    public function __construct(array $comments)
    {
        $this->comments = $comments;
    }

    public function getComments(): array
    {
        return $this->comments;
    }
}