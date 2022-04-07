<?php

namespace App\Services\Article\Update;

class ArticleUpdateRequest {

    private string $title;
    private string $text;
    private int $categoryId;
    private int $articleId;

    public function __construct(string $title, string $text, int $categoryId, int $articleId)
    {
        $this->title = $title;
        $this->text = $text;
        $this->categoryId = $categoryId;
        $this->articleId = $articleId;
    }

    public function getArticleId(): int
    {
        return $this->articleId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

}