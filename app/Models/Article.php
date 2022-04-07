<?php

namespace App\Models;

class Article {

    private string $title;
    private string $text;
    private int $categoryId;
    private ?string $createdAt;
    private ?int $id;

    public function __construct(string $title, string $text, int $categoryId, ?string $createdAt = null, ?int $id = null)
    {
        $this->title = $title;
        $this->text = $text;
        $this->categoryId = $categoryId;
        $this->createdAt = $createdAt;
        $this->id = $id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    public function getText(): string
    {
        return $this->text;
    }

}