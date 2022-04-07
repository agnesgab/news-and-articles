<?php

namespace App\Services\Comment\Add;

use App\Models\Comment;
use App\Repositories\Comment\CommentRepository;
use App\Repositories\Comment\MysqlCommentRepository;

class CommentAddService
{
    private CommentRepository $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function execute(CommentAddRequest $request)
    {
        $comment = new Comment($request->getUsername(), $request->getComment(), $request->getArticleId());
        $this->commentRepository->add($comment);
    }
}