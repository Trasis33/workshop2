<?php

//INCLUDE THE FILES NEEDED...

require_once('view/LoginView.php');
require_once('view/RegisterView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');

class Application
{
  private $loginView;
  private $registerView;
  private $dateTimeView;
  private $layoutView;

  public function __construct()
  {
    $this->loginView = new LoginView();
    $this->registerView = new RegisterView();
    $this->dateTimeView = new DateTimeView();
    $this->layoutView = new LayoutView();
  }
  //CREATE OBJECTS OF THE VIEWS
  // $v = new LoginView();
  // $dtv = new DateTimeView();
  // $lv = new LayoutView();

  public function run()
  {
    if ($this->layoutView->userHasClickedRegister()) {
      $this->layoutView->render(false, $this->registerView, $this->dateTimeView);
    } else {
      $this->layoutView->render(false, $this->loginView, $this->dateTimeView);
    }
  }
}
