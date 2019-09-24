<?php

namespace core;

use PDO;
use PDOException;

abstract class Model
{
  private $conf;

  public function __construct () {
    $serverName = gethostbyaddr($_SERVER['REMOTE_ADDR']);
    if ($serverName == 'localhost') {
        $this->conf = new \localConfig();
    } else {
        $this->conf = new \productionConfig();
    }
}

  protected static function getDb()
  {
    static $db = null;

    if ($db === null) {

      try {
        $dsn = 'mysql:host=' . Config::DB_HOST . ';dbname=' .
        Config::DB_NAME . ';charset=utf8';

        $db = new PDO($dsn, Config::DB_USER, COnfig::DB_PASS);

        return $db;

      } catch (PDOException $e){
        echo $e->getMessage();
      }
    }
  }
}