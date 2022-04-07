<?php

namespace App\Repositories\Comment;

use App\Database;
use App\Models\Comment;

class MysqlCommentRepository implements CommentRepository
{
    public function add(Comment $comment)
    {
        Database::connection()
            ->insert('comments', [
                'article_id' => $comment->getArticleId(),
                'username' => $comment->getUsername(),
                'comment' => $comment->getComment(),
            ]);
    }

    public function delete(int $commentId)
    {
        Database::connection()
            ->delete('comments', ['id' => $commentId]);
    }

    public function showArticleComments(int $articleId): array
    {
        return Database::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('comments')
            ->where('article_id = ?')
            ->setParameter(0, $articleId)
            ->orderBy('created_at', 'DESC')
            ->executeQuery()
            ->fetchAllAssociative();
    }
}