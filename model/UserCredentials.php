<?php

namespace model;

class UserCredentials
{
  private $username;
  private $password;
  private $keepLoggedIn;

  public function __construct(string $username, string $password, bool $keepLoggedIn)
  {
    $this->username = $this->applyFilter($username);
    $this->password = $this->applyFilter($password);
    $this->keepLoggedIn = $keepLoggedIn;
  }

  public function getUsername()
  {
    return $this->username;
  }

  public function getPassword()
  {
      return $this->password;
  }

  public function getKeepLoggedIn()
  {
      return $this->keepLoggedIn;
  }

  public static function applyFilter(string $rawInput)
  {
    return trim(htmlentities($rawInput));
  }
}