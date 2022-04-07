<?php

namespace App\Services\Article\Index;

use App\Models\Article;
use App\Repositories\Article\ArticleRepository;

class ArticleIndexService
{
    private ArticleRepository $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function execute(): ArticleIndexResponse
    {
        $articlesQuery = $this->articleRepository->index();
        $articles = [];
        foreach ($articlesQuery as $data) {
            $articles[] = new Article(
                $data['title'],
                $data['text'],
                $data['category_id'],
                $data['created_at'],
                $data['id']
            );
        }

        return new ArticleIndexResponse($articles);

    }

}