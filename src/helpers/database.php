<?php
namespace Project\Helpers;

class Database {
    public static function get_connection(bool $autocommit = true): \mysqli {
        $database_connection = mysqli_connect("mysql", "root", "root", "php_api", 3306);
        if (!$database_connection) {
            throw new \Exception("Database connection is down.");
        }
        if ($autocommit) {
            $database_connection->autocommit(true);
        }
        return $database_connection;
    }
}