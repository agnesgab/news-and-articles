<?php

namespace App\Models;

class Category {

    private string $categoryName;
    private ?int $categoryId;

    public function __construct(string $categoryName, ?int $categoryId)
    {
        $this->categoryName = $categoryName;
        $this->categoryId = $categoryId;
    }

    public function getCategoryId(): ?int
    {
        return $this->categoryId;
    }

    public function getCategoryName(): string
    {
        return $this->categoryName;
    }
}