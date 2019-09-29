<?php

namespace model;

use PDO;
use PDOException;

class Database
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
        $dsn = 'mysql:host=' . $this->conf::DB_HOST . ';dbname=' .
        $this->conf::DB_NAME . ';charset=utf8';

        $db = new PDO($dsn, $this->conf::DB_USER, $this->conf::DB_PASS);

        return $db;

      } catch(PDOException $e)
      {
        echo $e->getMessage();
      }
    }
  }
}