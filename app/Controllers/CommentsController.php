<?php

namespace App\Controllers;

use App\Redirect;
use App\Services\Comment\Add\CommentAddRequest;
use App\Services\Comment\Add\CommentAddService;
use App\Services\Comment\Delete\CommentDeleteRequest;
use App\Services\Comment\Delete\CommentDeleteService;
use Psr\Container\ContainerInterface;

class CommentsController
{
    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function add(array $vars): Redirect
    {
        //Submitted data from comment form and article id in URL requested
        $articleId = (int)$vars['id'];
        $request = new CommentAddRequest($articleId, $_POST['username'], $_POST['comment']);

        //Comment object from submitted data created and data stored in DB
        $service = $this->container->get(CommentAddService::class);
        $service->execute($request);

        //Redirect to the same article
        return new Redirect('/show/' . $articleId);
    }

    public function delete(array $vars): Redirect
    {
        //Article id and comment id from URL requested
        $commentId = (int)$vars['id'];
        $articleId = (int)$vars['articleId'];
        $request = new CommentDeleteRequest($commentId);

        //Comment removed form DB
        $service = $this->container->get(CommentDeleteService::class);
        $service->execute($request);

        //Redirect to the same article
        return new Redirect('/show/' . $articleId);

    }
}