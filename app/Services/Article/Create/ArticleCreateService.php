<?php

namespace App\Services\Article\Create;

use App\Models\Category;
use App\Repositories\Category\CategoryRepository;

class ArticleCreateService
{
    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function execute(): ArticleCreateResponse
    {
        $categoriesQuery = $this->categoryRepository->index();
        $categories = [];
        foreach ($categoriesQuery as $data) {
            $categories[] = new Category($data['category_name'], $data['id']);
        }

        return new ArticleCreateResponse($categories);

    }

}