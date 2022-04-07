<?php

namespace App\Repositories\Category;

use App\Database;

class MysqlCategoryRepository implements CategoryRepository
{

    public function index(): array
    {
        return Database::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('categories')
            ->fetchAllAssociative();
    }

    public function show(int $categoryId): array
    {
        return Database::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('categories', 'c')
            ->innerJoin('c', 'articles', 'a', 'c.id = a.category_id')
            ->where('a.category_id = ?')
            ->setParameter(0, $categoryId)
            ->executeQuery()
            ->fetchAllAssociative();
    }
}