<?php

namespace App\Services\Comment\Index;

use App\Models\Comment;
use App\Repositories\Comment\CommentRepository;
use App\Repositories\Comment\MysqlCommentRepository;

class CommentIndexService
{
    private CommentRepository $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function execute(CommentIndexRequest $request): CommentIndexResponse
    {
        $commentsQuery = $this->commentRepository->showArticleComments($request->getArticleId());
        $comments = [];
        foreach ($commentsQuery as $data) {
            $comments[] = new Comment($data['username'], $data['comment'], $data['article_id'], $data['created_at'], $data['id']);
        }

        return new CommentIndexResponse($comments);
    }
}