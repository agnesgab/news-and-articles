<?php

namespace App\Services\Article\Show;

use App\Models\Article;
use App\Repositories\Article\ArticleRepository;

class ArticleShowService
{
    private ArticleRepository $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function execute(ArticleShowRequest $request): ArticleShowResponse
    {
        $articleQuery = $this->articleRepository->show($request->getArticleId());
        $article = new Article(
            $articleQuery['title'],
            $articleQuery['text'],
            $articleQuery['category_id'],
            $articleQuery['created_at'],
            $articleQuery['id']
        );

        return new ArticleShowResponse($article);
    }

}