<?php

namespace App\Services\Article\Save;

use App\Models\Article;
use App\Repositories\Article\ArticleRepository;

class ArticleSaveService
{
    private ArticleRepository $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function execute(ArticleSaveRequest $request)
    {
        $article = new Article($request->getTitle(), $request->getText(), $request->getCategoryId());
        $this->articleRepository->save($article);
    }
}