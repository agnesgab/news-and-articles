<?php

namespace App\Models;

class Comment
{
    private string $username;
    private string $comment;
    private int $articleId;
    private ?string $createdAt;
    private ?int $id;

    public function __construct(string $username, string $comment, int $articleId, ?string $createdAt = null, ?int $id = null)
    {
        $this->username = $username;
        $this->comment = $comment;
        $this->articleId = $articleId;
        $this->createdAt = $createdAt;
        $this->id = $id;
    }

    public function getComment(): string
    {
        return $this->comment;
    }

    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getArticleId(): int
    {
        return $this->articleId;
    }
}