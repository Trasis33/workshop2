<?php

require_once('auth/view/LoginView.php');
require_once('auth/view/RegisterView.php');
require_once('auth/view/DateTimeView.php');
require_once('auth/view/LayoutView.php');

require_once('auth/model/LoginModel.php');
require_once('auth/model/UserCredentials.php');
require_once('auth/model/SignupCredentials.php');
require_once('auth/model/Exceptions.php');
require_once('auth/model/UserStorage.php');

require_once('auth/controller/LoginController.php');
require_once('auth/controller/SignupController.php');
require_once('auth/controller/MainController.php');


class Application
{

  private $mainController;

  public function __construct()
  {
    $this->mainController = new \auth\controller\MainController();
  }

  public function run()
  {
    $this->mainController->run();
  }

  public function getMainController(): \auth\controller\MainController
  {
    return $this->mainController;
  }
}
