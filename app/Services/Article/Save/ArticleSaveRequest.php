<?php

namespace App\Services\Article\Save;

class ArticleSaveRequest {

    private string $title;
    private string $text;
    private int $categoryId;

    public function __construct(string $title, string $text, int $categoryId)
    {
        $this->title = $title;
        $this->text = $text;
        $this->categoryId = $categoryId;
    }

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}
