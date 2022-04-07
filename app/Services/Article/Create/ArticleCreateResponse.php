<?php

namespace App\Services\Article\Create;

class ArticleCreateResponse
{
    private array $categories;

    public function __construct(array $categories)
    {
        $this->categories = $categories;
    }

    public function getCategories(): array
    {
        return $this->categories;
    }
}