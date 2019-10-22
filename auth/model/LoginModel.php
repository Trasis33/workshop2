<?php

namespace model;

class LoginModel
{

  private $isLoggedIn = false;

  public function __construct()
  {
  }

  public function tryToLogIn(\model\UserCredentials $userCredentials)
  {
    if($userCredentials->getUsername() == "Admin" && $userCredentials->getPassword() == "Password")
    {
      return true;
    } else
    {
      return false;
    }
  }

  public function saveUser($credentials)
  {
    if($credentials->getUsername() == 'Admin')
    {
      throw new UsernameAlReadyExistsException("User exists, pick another username.");
    } else
    {
      return true;
    }
  }

  public function getIsLoggedIn()
  {
    return $this->isLoggedIn;
  }

  public function setIsLoggedIn(bool $isLoggedIn)
  {
    $this->isLoggedIn = $isLoggedIn;
  }

  public function setIsLoggedOut()
  {
    $this->setIsLoggedIn(false);
  }
}