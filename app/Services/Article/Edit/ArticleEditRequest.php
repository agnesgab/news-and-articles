<?php

namespace App\Services\Article\Edit;

class ArticleEditRequest
{
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