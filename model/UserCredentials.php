<?php

namespace model;

class UserCredentials
{
  private $username;
  private $password;
  private $keepLoggedIn;

  public function __construct(Username $username, Password $password, bool $keepLoggedIn)
  {
    $this->username = $username;
    $this->password = $password;
    $this->keepLoggedIn = $keepLoggedIn;
  }

  public function getUsername() {
    return $this->username;
  }
  public function getPassword() {
      return $this->password;
  }
  public function ifKeepLoggedIn() {
      return $this->keepLoggedIn;
  }
}