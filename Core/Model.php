<?php

namespace Core;

use PDO;
use App\Config;
use PDOException;

abstract class Model
{
  protected static function getDb()
  {
    static $db = null;

    if ($db === null) {
      // $host = 'localhost';
      // $dbname = 'workshop2';
      // $username = 'root';
      // $password = 'root';

      try {
        $dsn = 'mysql:host=' . Config::DB_HOST . ';dbname=' .
        Config::DB_NAME . ';charset=utf8';

        $db = new PDO($dsn, Config::DB_USER, COnfig::DB_PASSWORD);

        return $db;

      } catch (PDOException $e){
        echo $e->getMessage();
      }
    }
  }
}