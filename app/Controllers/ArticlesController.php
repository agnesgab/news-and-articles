<?php

namespace App\Controllers;

use App\Redirect;
use App\Services\Article\Delete\ArticleDeleteRequest;
use App\Services\Article\Delete\ArticleDeleteService;
use App\Services\Article\Edit\ArticleEditRequest;
use App\Services\Article\Edit\ArticleEditService;
use App\Services\Article\Index\ArticleIndexService;
use App\Services\Article\Save\ArticleSaveRequest;
use App\Services\Article\Save\ArticleSaveService;
use App\Services\Article\Show\ArticleShowRequest;
use App\Services\Article\Show\ArticleShowService;
use App\Services\Article\Update\ArticleUpdateRequest;
use App\Services\Article\Update\ArticleUpdateService;
use App\Services\Category\Index\CategoryIndexService;
use App\Services\Comment\Index\CommentIndexRequest;
use App\Services\Comment\Index\CommentIndexService;
use App\View;
use Psr\Container\ContainerInterface;

class ArticlesController
{
    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function index(): View
    {
        //All articles requested
        $service = $this->container->get(ArticleIndexService::class);

        //Array of Article objects returned
        $response = $service->execute();

        //Returned array of Article objects set as View variables
        return new View('Article/index.html', ['articles' => $response->getArticles()]);
    }

    public function show(array $vars): View
    {
        //Request selected article data by article id from URL
        $articleId = (int)$vars['id'];
        $request = new ArticleShowRequest($articleId);

        //Returned data as Article object
        $service = $this->container->get(ArticleShowService::class);
        $response = $service->execute($request);

        //Comments for selected article requested
        $commentsRequest = new CommentIndexRequest($articleId);
        //Array of Comment objects returned
        $commentsService = $this->container->get(CommentIndexService::class);
        $comments = $commentsService->execute($commentsRequest)->getComments();

        //Article object and comments array set as View variables
        return new View('Article/show.html', ['article' => $response->getArticle(), 'comments' => $comments]);
    }

    public function createNewArticle(): View
    {
        //Requesting all available categories
        $service = $this->container->get(CategoryIndexService::class);
        $categories = $service->execute()->getCategories();

        //Array of Category objects returned as View variable, each used as <option>
        return new View('Article/create.html', ['categories' => $categories]);
    }

    public function save(): Redirect
    {
        //Requesting submitted data from article create form
        $request = new ArticleSaveRequest($_POST['title'], $_POST['text'], (int)$_POST['category']);

        //Saving new article in DB
        $service = $this->container->get(ArticleSaveService::class);
        $service->execute($request);

        return new Redirect('/');
    }

    public function edit(array $vars): View
    {
        //Requesting article data by article id from URL
        $request = new ArticleEditRequest((int)$vars['id']);

        //Article object with selected article data returned
        $service = $this->container->get(ArticleEditService::class);
        $response = $service->execute($request);

        //Getting all available categories for possibility to edit article category
        $categoriesService = $this->container->get(CategoryIndexService::class);
        $categories = $categoriesService->execute()->getCategories();

        //Article object returned as View variable for its data to be set as input form values, categories set for <option>
        return new View('Article/edit.html', ['article' => $response->getArticle(), 'categories' => $categories]);
    }

    public function update(array $vars): Redirect
    {
        //Request submitted data from article edit form and article id from URL
        $articleId = (int)$vars['id'];
        $request = new ArticleUpdateRequest($_POST['title'], $_POST['text'], (int)$_POST['category'], $articleId);

        //Update article data in DB
        $service = $this->container->get(ArticleUpdateService::class);
        $service->execute($request);

        //Return to the edited article
        return new Redirect('/show/' . $articleId);
    }

    public function delete(array $vars): Redirect
    {
        //Request article id form URL
        $articleId = (int)$vars['id'];
        $request = new ArticleDeleteRequest($articleId);

        //Delete article from DB
        $service = $this->container->get(ArticleDeleteService::class);
        $service->execute($request);

        return new Redirect('/');
    }
}
