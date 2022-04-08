# News and Articles

## Table of contents

* General info
* Technologies
* Setup

## General info
This is news and articles project. User can select article to read, filter 
articles by category, add comments. 
By clicking "Login as Admin", more options are provided - create/edit/delete articles, 
delete user comments. <br>

To log in as admin: <br>
name: **admin** <br>
password: **password**

## Technologies

Project is created with:

* PHP 7.4
* HTML5
* CSS / Bootstrap v5.1.3

## Setup

**1. install Composer:**

```
$ composer install
```
**2. set up database:** <br>
[Database](app/Database.php) - provide connection parameters - 'dbname', 'user', 'password' <br>
[Data in CSV](fixtures) Import data tables in your database <br>
[Database Schema ](schema.sql) can be found here <br>

**3. open project locally**


## Packages & documentation: <br>

* [Nikic/Fast-route](https://github.com/nikic/FastRoute) - request router
* [Doctrine/Dbal](https://www.doctrine-project.org/projects/doctrine-dbal/en/latest/) - database abstraction layer
* [Twig](https://twig.symfony.com/doc/3.x/) - template language for PHP
* [PHP-DI](https://php-di.org/doc/) - dependency injection container for PHP


