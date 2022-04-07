<?php

namespace App\Services\Category\Index;

class CategoryIndexResponse {

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