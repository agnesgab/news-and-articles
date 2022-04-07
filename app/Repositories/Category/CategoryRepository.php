<?php

namespace App\Repositories\Category;

interface CategoryRepository {

    public function index();
    public function show(int $categoryId);

}