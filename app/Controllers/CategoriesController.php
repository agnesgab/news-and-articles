<?php

namespace App\Controllers;

use App\Services\Category\Show\CategoryShowRequest;
use App\Services\Category\Show\CategoryShowService;
use App\View;
use Psr\Container\ContainerInterface;

class CategoriesController {

    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function showCategoryArticles(array $vars): View
    {
        //Category requested by category id in URL
        $categoryId = (int)$vars['id'];
        $request = new CategoryShowRequest($categoryId);

        //Array of Article objects form requested category returned
        $service = $this->container->get(CategoryShowService::class);
        $response = $service->execute($request);

        //Convert category name first letter to uppercase
        $category = ucwords($response->getCategoryName());

        //Article objects array and category name set as View variables
        return new View('Categories/category_articles.html', ['articles' => $response->getArticles(), 'category'=>$category]);
    }

}