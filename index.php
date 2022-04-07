<?php

use App\Redirect;
use App\Repositories\Admin\AdminRepository;
use App\Repositories\Admin\CSVAdminRepository;
use App\Repositories\Admin\MysqlAdminRepository;
use App\Repositories\Article\ArticleRepository;
use App\Repositories\Article\CSVArticleRepository;
use App\Repositories\Article\MysqlArticleRepository;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Category\CSVCategoryRepository;
use App\Repositories\Category\MysqlCategoryRepository;
use App\Repositories\Comment\CommentRepository;
use App\Repositories\Comment\CSVCommentRepository;
use App\Repositories\Comment\MysqlCommentRepository;
use App\View;
use FastRoute\Dispatcher;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once 'vendor/autoload.php';

//Possible to change data source using dependency injections (e.g. switch from MysqlArticleRepository to CSVArticleRepository)
$builder = new DI\ContainerBuilder();
$builder->addDefinitions([
    ArticleRepository::class => DI\create(MysqlArticleRepository::class),
    CategoryRepository::class => DI\create(MysqlCategoryRepository::class),
    CommentRepository::class => DI\create(MysqlCommentRepository::class),
    AdminRepository::class => DI\create(MysqlAdminRepository::class)
]);
$container = $builder->build();


//SESSION
$isAdmin = false;
session_start();
if (isset($_SESSION['id'])) {
    $isAdmin = $_SESSION['admin'];
}

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {

    //Articles
    $r->addRoute('GET', '/', ['App\Controllers\ArticlesController', 'index']);
    $r->addRoute('GET', '/show/{id:\d+}', ['App\Controllers\ArticlesController', 'show']);
    $r->addRoute('GET', '/create', ['App\Controllers\ArticlesController', 'createNewArticle']);
    $r->addRoute('POST', '/create', ['App\Controllers\ArticlesController', 'save']);
    $r->addRoute('GET', '/edit/{id:\d+}', ['App\Controllers\ArticlesController', 'edit']);
    $r->addRoute('POST', '/edit/{id:\d+}', ['App\Controllers\ArticlesController', 'update']);
    $r->addRoute('POST', '/delete/{id:\d+}', ['App\Controllers\ArticlesController', 'delete']);

    //Comments
    $r->addRoute('POST', '/show/{id:\d+}', ['App\Controllers\CommentsController', 'add']);
    $r->addRoute('POST', '/show/{articleId:\d+}/delete/comment/{id:\d+}', ['App\Controllers\CommentsController', 'delete']);

    //Categories
    $r->addRoute('GET', '/category/{id:\d+}', ['App\Controllers\CategoriesController', 'showCategoryArticles']);

    //Admin
    $r->addRoute('GET', '/login', ['App\Controllers\AdminsController', 'login']);
    $r->addRoute('POST', '/login', ['App\Controllers\AdminsController', 'validate']);
    $r->addRoute('GET', '/logout', ['App\Controllers\AdminsController', 'logout']);


});

// Fetch method and URI from somewhere
/**
 * @param Dispatcher $dispatcher
 * @return void
 * @throws \Twig\Error\LoaderError
 * @throws \Twig\Error\RuntimeError
 * @throws \Twig\Error\SyntaxError
 */
function fetchMethodAndURIFromSomewhere(Dispatcher $dispatcher, $container): void
{
    $httpMethod = $_SERVER['REQUEST_METHOD'];
    $uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
    if (false !== $pos = strpos($uri, '?')) {
        $uri = substr($uri, 0, $pos);
    }
    $uri = rawurldecode($uri);

    $routeInfo = $dispatcher->dispatch($httpMethod, $uri);
    switch ($routeInfo[0]) {
        case FastRoute\Dispatcher::NOT_FOUND:
            // ... 404 Not Found
            var_dump('404 Not Found');
            break;
        case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
            $allowedMethods = $routeInfo[1];
            // ... 405 Method Not Allowed
            var_dump('404 Not Allowed');
            break;
        case FastRoute\Dispatcher::FOUND:

            //route example
            //$r->addRoute(0=>[0=>'GET', 1=>'/'], 1=>[0=>'App\Controllers\ArticlesController', 1=>'index']);
            $controller = $routeInfo[1][0];
            $method = $routeInfo[1][1];
            $vars = $routeInfo[2];

            /** @var View $response */
            $response = (new $controller($container))->$method($vars);

            $loader = new FilesystemLoader('app/Views');
            $twig = new Environment($loader);

            //Creating isAdmin superglobal(boolean), to be available in all Twig templates
            $twig->addGlobal('isAdmin', $_SESSION['admin']);

            if ($response instanceof View) {
                echo $twig->render($response->getPath(), $response->getVariables());
            }

            if ($response instanceof Redirect) {
                header('Location: ' . $response->getLocation());
                exit;
            }

            break;
    }
}

fetchMethodAndURIFromSomewhere($dispatcher, $container);
