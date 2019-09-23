<?php

namespace App\Model;

use PDO;

class User extends \Core\Model
{
  public $errors = [];

  public function __construct($data) {
    foreach ($data as $key => $value) {
      $this->$key = $value;
    }
  }

  public function save() {

    $this->validate();

    if (empty($this->errors)) {
      $password_hash = password_hash($this->password, PASSWORD_DEFAULT);

      $sql = 'INSERT INTO users (name, password_hash)
              VALUES (:name, :password_hash)';

      $db = static::getDb();
      $stmt = $db->prepare($sql);

      $stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
      $stmt->bindValue(':password_hash', $password_hash, PDO::PARAM_STR);

      return $stmt->execute();
    }
    return false;
  }

  public function validate()
  {
    if ($this->name == '') {
      $this->errors[] = 'Username is missing';
    }
    if (filter_var($this->email, FILTER_VALIDATE_EMAIL) === false) {
      $this->errors[] = 'Invalid email';
    }
    if ($this->password != $this->password_confirmation) {
      $this->errors[] = 'Password must match confirmation';
    }
    if (strlen($this->password) == 0) {
      $this->errors[] = 'Password is missing';
    }
  }

  public static function usernameExists($name)
  {
    return static::findByUsername($name) !== false;
  }

  public static function findByUsername($name)
  {
    $sql = 'SELECT * FROM users WHERE name = :name';

    $db = static::getDB();
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);

    $stmt->execute();

    return $stmt->fetch();
  }
}