<?php

namespace App\Services\Article\Edit;

use App\Models\Article;
use App\Repositories\Article\ArticleRepository;

class ArticleEditService
{
    private ArticleRepository $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function execute(ArticleEditRequest $request): ArticleEditResponse
    {
        $articleQuery = $this->articleRepository->edit($request->getArticleId());
        $article = new Article($articleQuery['title'], $articleQuery['text'], $articleQuery['category_id'], $articleQuery['created_at'], $articleQuery['id']);

        return new ArticleEditResponse($article);
    }
}