<?php

namespace App\Services\Comment\Index;

class CommentIndexRequest {

    private int $articleId;

    public function __construct(int $articleId)
    {
        $this->articleId = $articleId;
    }

    public function getArticleId(): int
    {
        return $this->articleId;
    }
}