<?php

namespace Teiku;

use PDO;

class Database
{

    private static $instance = null;
    private $connection;

    private function __construct()
    {
        $creds = json_decode(file_get_contents(APP . '/db/credentials'));
        if ($creds->protocol === 'sqlite') {
            $this->connection = new PDO($creds->dsn);
            $this->connection->exec('PRAGMA foreign_keys = 1');
        } else {
            $this->connection = new PDO($creds->dsn, $creds->user, $creds->password);
        }
    }

    private function __clone()
    {
    }

    public static function connect(): Database
    {
        return self::$instance = self::$instance ?? new Database();
    }

    public function open(): PDO
    {
        return $this->connection;
    }

}