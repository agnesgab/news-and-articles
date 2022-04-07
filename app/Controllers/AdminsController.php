<?php

namespace App\Controllers;

use App\Redirect;
use App\Services\Admin\Validate\AdminValidateRequest;
use App\Services\Admin\Validate\AdminValidateService;
use App\View;
use Psr\Container\ContainerInterface;

class AdminsController {

    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function login(): View
    {
        //Login form
        return new View('Admin/login.html');
    }

    public function validate(): Redirect
    {
        //Requesting submitted data - name and password
        $request = new AdminValidateRequest($_POST['admin-name'], $_POST['admin-password']);
        $service = $this->container->get(AdminValidateService::class);

        //If submitted data invalid - redirect to empty login form
        if(!$service->execute($request)){
            return new Redirect('/login');
        }

        //If submitted data valid - set session data, start session, you are admin now
        $_SESSION['id'] = 5;
        $_SESSION['admin'] = true;

        //Return to home page as admin with more options (edit, delete, create article etc.)
        return new Redirect('/');
    }

    public function logout(): Redirect
    {
        //Session data deleted, $_SESSION['admin'] = false
        session_destroy();

        //Return to home page as user
        return new Redirect('/');
    }
}