<?php

namespace App\Repositories\Article;

use App\Models\Article;

interface ArticleRepository {

    public function index();
    public function show(int $articleId);
    public function save(Article $article);
    public function edit(int $articleId);
    public function update(Article $article);
    public function delete(int $articleId);

}