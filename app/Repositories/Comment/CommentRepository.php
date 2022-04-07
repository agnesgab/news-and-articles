<?php

namespace App\Repositories\Comment;

use App\Models\Comment;

interface CommentRepository {

    public function add(Comment $comment);
    public function delete(int $commentId);
    public function showArticleComments(int $articleId);

}