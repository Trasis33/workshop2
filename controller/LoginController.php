<?php

namespace controller;

class LoginController
{
  private $loginView;
  private $loginModel;
  private $userStorage;

  public function __construct(\view\LoginView $loginView, \model\LoginModel $loginModel, \model\UserStorage $userStorage)
  {
    $this->loginView = $loginView;
    $this->loginModel = $loginModel;
    $this->userStorage = $userStorage;
  }

  public function login()
  {
    $credentials = $this->loginView->getUserCredentials();
    $loginMatchWithCredentials = $this->loginModel->tryToLogIn($credentials);
    $userWantsToStayLoggedIn = $credentials->getKeepLoggedIn();

    if($loginMatchWithCredentials && $userWantsToStayLoggedIn)
    {
      $this->userStorage->saveUser($credentials);
      $this->loginView->setMessage("Welcome and you will be remembered");

      return true;
    } else if($loginMatchWithCredentials)
    {
      $this->loginView->setMessage("Welcome");
      $this->userStorage->saveUser($credentials);

      return true;
    } else
    {
      $this->loginView->setMessage("Wrong name or password");

      return false;
    }
  }

  public function logout()
  {
    $this->userStorage->destroySession();
    $this->loginView->setMessage("Bye bye!");
    $this->loginModel->setIsLoggedOut();
  }

}