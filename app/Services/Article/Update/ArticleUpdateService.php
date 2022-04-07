<?php

namespace App\Services\Article\Update;

use App\Models\Article;
use App\Repositories\Article\ArticleRepository;

class ArticleUpdateService
{
    private ArticleRepository $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function execute(ArticleUpdateRequest $request)
    {
        $article = new Article($request->getTitle(), $request->getText(), $request->getCategoryId(), null, $request->getArticleId());
        $this->articleRepository->update($article);
    }
}