<?php

//INCLUDE THE FILES NEEDED...

require_once('view/LoginView.php');
require_once('view/RegisterView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');

require_once('model/User.php');

class Application
{
  private $loginView;
  private $registerView;
  private $dateTimeView;
  private $layoutView;

  private $storage;
  private $isLoggedIn;

  public function __construct()
  {
    $this->storage = new \model\User();

    $this->loginView = new \view\LoginView($this->storage);
    $this->registerView = new \view\RegisterView();
    $this->dateTimeView = new \view\DateTimeView();
    $this->layoutView = new \view\LayoutView();

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
  private function changeState() {

    $this->isLoggedIn = $this->storage->getIsLoggedIn();
    $this->layoutView->userHasClickedRegister();
    $this->loginView->ifUserWantsToLogin();

  }
  private function output() {
    if($this->layoutView->userHasClickedRegister())
    {
      return $this->layoutView->render($this->isLoggedIn, $this->registerView, $this->dateTimeView);

    }
    return $this->layoutView->render($this->isLoggedIn, $this->loginView, $this->dateTimeView);
  }
}
