<?php

namespace App\Services\Comment\Add;

class CommentAddRequest {

    private int $articleId;
    private string $username;
    private string $comment;

    public function __construct(int $articleId, string $username, string $comment)
    {
        $this->articleId = $articleId;
        $this->username = $username;
        $this->comment = $comment;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getComment(): string
    {
        return $this->comment;
    }

    public function getArticleId(): int
    {
        return $this->articleId;
    }
}