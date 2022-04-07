<?php

namespace App\Services\Comment\Delete;

use App\Repositories\Comment\CommentRepository;
use App\Repositories\Comment\MysqlCommentRepository;

class CommentDeleteService {

    private CommentRepository $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function execute(CommentDeleteRequest $request)
    {
        $this->commentRepository->delete($request->getCommentId());
    }
}