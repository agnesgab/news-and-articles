<?php

namespace App\Services\Article\Index;

class ArticleIndexResponse {

    private array $articles;

    public function __construct(array $articles)
    {
        $this->articles = $articles;
    }

    public function getArticles(): array
    {
        return $this->articles;
    }
}