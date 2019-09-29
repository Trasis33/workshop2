<?php

//INCLUDE THE FILES NEEDED...


require_once('view/LoginView.php');
require_once('view/RegisterView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');

require_once('model/LoginModel.php');
require_once('model/UserCredentials.php');
require_once('model/SignupCredentials.php');
require_once('model/Exceptions.php');
require_once('model/UserStorage.php');

require_once('controller/LoginController.php');
require_once('controller/SignupController.php');

// spl_autoload_register(function ($class) {
//   $root = dirname(__DIR__);
//   $file = $root . '/' . str_replace('\\', '/', $class) . '.php';
//   if (is_readable($file)) {
//     require $root . '/' . str_replace('\\', '/', $class) . '.php';
//   }
// });

class Application
{
  private $loginView;
  private $registerView;
  private $dateTimeView;
  private $layoutView;

  private $loginModel;

  private $loginController;
  private $signupController;

  private $userStorage;

  public function __construct()
  {
    $this->loginView = new \view\LoginView();
    $this->registerView = new \view\RegisterView();
    $this->dateTimeView = new \view\DateTimeView();
    $this->layoutView = new \view\LayoutView();

    $this->userStorage = new \model\UserStorage();

    $this->loginModel = new \model\LoginModel();
    $this->loginController = new controller\LoginController($this->loginView, $this->loginModel, $this->userStorage);
    $this->signupController = new controller\SignupController($this->registerView, $this->loginModel);
  }
  //CREATE OBJECTS OF THE VIEWS
  // $v = new LoginView();
  // $dtv = new DateTimeView();
  // $lv = new LayoutView();

  public function run()
  {
    $this->changeState();
    $this->output();
  }
  private function changeState()
  {
    $userSession = $this->userStorage->loadUser();

    if($userSession)
    {
      $this->loginModel->setIsLoggedIn(true);
    }

    if($this->loginModel->getIsLoggedIn())
    {
      if($this->loginView->ifUserWantsToLogout())
      {
        $this->loginController->logout();
      }
    } else
    {
      if($this->registerView->ifUserWantsToRegister())
      {
        $this->signupController->register();
      } else if($this->loginView->ifUserWantsToLogin())
      {
        $this->loginModel->setIsLoggedIn($this->loginController->login());
      }
    }


    // $this->isLoggedIn = $this->storage->getIsLoggedIn();
    // $this->loginView->ifUserWantsToLogin();
    // $this->registerView->ifUserWantsToRegister();

  }
  private function output()
  {
    if($this->layoutView->userHasClickedRegister())
    {
      // $this->signupController->register();
      return $this->layoutView->render($this->loginModel->getIsLoggedIn(), $this->registerView, $this->dateTimeView);
    } else
    {
      return $this->layoutView->render($this->loginModel->getIsLoggedIn(), $this->loginView, $this->dateTimeView);
    }
  }
}
