<?php

namespace App\Repositories\Article;

use App\Database;
use App\Models\Article;

class MysqlArticleRepository implements ArticleRepository
{
    public function index(): array
    {
        return Database::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('articles')
            ->orderBy('created_at', 'DESC')
            ->executeQuery()
            ->fetchAllAssociative();
    }

    public function show(int $articleId)
    {
        return Database::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('articles')
            ->where('id = ?')
            ->setParameter(0, $articleId)
            ->executeQuery()
            ->fetchAssociative();
    }

    public function save(Article $article)
    {
        Database::connection()
            ->insert('articles', [
                'category_id' => $article->getCategoryId(),
                'title' => $article->getTitle(),
                'text' => $article->getText()]);
    }

    public function edit(int $articleId)
    {
        return Database::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('articles')
            ->where('id = ?')
            ->setParameter(0, $articleId)
            ->executeQuery()
            ->fetchAssociative();
    }


    public function update(Article $article)
    {
        Database::connection()
            ->update('articles', [
                'title' => $article->getTitle(),
                'text' => $article->getText(),
                'category_id' => $article->getCategoryId()
            ], ['id' => $article->getId()]);
    }

    public function delete(int $articleId)
    {
        Database::connection()
            ->delete('articles', ['id' => $articleId]);
    }
}