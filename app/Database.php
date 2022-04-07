<?php

namespace App;

use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Exception;

class Database {

    private static $connection = null;

    /**
     * @throws Exception
     */
    public static function connection()
    {

        if(self::$connection === null){
            $connectionParams = [
                'dbname' => '',
                'user' => '',
                'password' => '',
                'host' => 'localhost',
                'driver' => 'pdo_mysql',
            ];

            self::$connection = DriverManager::getConnection($connectionParams);
        }

        return self::$connection;
    }
}