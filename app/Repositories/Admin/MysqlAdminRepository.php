<?php

namespace App\Repositories\Admin;

use App\Database;

class MysqlAdminRepository implements AdminRepository
{
    public function validate(string $adminName)
    {
        return Database::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('admins')
            ->where('name =?')
            ->setParameter(0, $adminName)
            ->executeQuery()
            ->fetchAssociative();
    }
}