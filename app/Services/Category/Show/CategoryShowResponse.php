<?php

namespace App\Services\Category\Show;

class CategoryShowResponse {

    private array $articles;
    private string $categoryName;

    public function __construct(array $articles, string $categoryName)
    {
        $this->articles = $articles;
        $this->categoryName = $categoryName;
    }

    public function getArticles(): array
    {
        return $this->articles;
    }

    public function getCategoryName(): string
    {
        return $this->categoryName;
    }
}