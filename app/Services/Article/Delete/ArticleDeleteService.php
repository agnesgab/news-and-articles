<?php

namespace App\Services\Article\Delete;

use App\Repositories\Article\ArticleRepository;

class ArticleDeleteService {

    private ArticleRepository $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function execute(ArticleDeleteRequest $request)
    {
        $this->articleRepository->delete($request->getArticleId());
    }
}