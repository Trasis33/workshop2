<?php

namespace controller;

class SignupController
{
  private $registerView;
  private $loginModel;

  public function __construct(\view\RegisterView $view, \model\LoginModel $loginModel)
  {
    $this->registerView = $view;
    $this->loginModel = $loginModel;
  }

  public function register()
  {
    $registerSuccess = false;

    try
    {
      $newCredentials = $this->registerView->getRegisterUserCredentials();
      $registerSuccess = $this->loginModel->saveUser($newCredentials);
    } catch(\model\UsernameAndPasswordEmptyException $e)
    {
      $this->registerView->setMessage($e->getMessage());
    } catch(\model\UserNameTooShortException $e)
    {
      $this->registerView->setMessage($e->getMessage());
    } catch(\model\PasswordTooShortException $e)
    {
      $this->registerView->setMessage($e->getMessage());
    } catch(\model\PasswordsDidNotMatchException $e)
    {
      $this->registerView->setMessage($e->getMessage());
    } catch(\model\UserAlReadyExistsException $e)
    {
      $this->registerView->setMessage($e->getMessage());
    } catch(\model\UsernameHasInvalidCharactersException $e)
    {
      $this->registerView->setMessage($e->getMessage());
    }

  if ($registerSuccess) {
      $this->registerView->setMessage('Successful registration');
  }
  }
}