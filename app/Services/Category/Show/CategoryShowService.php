<?php

namespace App\Services\Category\Show;

use App\Models\Article;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Category\MysqlCategoryRepository;

class CategoryShowService
{
    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function execute(CategoryShowRequest $request): CategoryShowResponse
    {
        $categoryArticlesQuery = $this->categoryRepository->show($request->getCategoryId());
        $articles = [];
        $categoryName = '';

        foreach ($categoryArticlesQuery as $data) {
            $articles[] = new Article($data['title'], $data['text'], $data['category_id'], $data['created_at'], $data['id']);
            $categoryName = $data['category_name'];
        }

        return new CategoryShowResponse($articles, $categoryName);
    }
}