<?php

//INCLUDE THE FILES NEEDED...

require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');

class Application
{
  private $loginView;
  private $dateTimeView;
  private $layoutView;

  public function __construct()
  {
    $this->loginView = new LoginView();
    $this->dateTimeView = new DateTimeView();
    $this->layoutView = new LayoutView();
  }
  //CREATE OBJECTS OF THE VIEWS
  // $v = new LoginView();
  // $dtv = new DateTimeView();
  // $lv = new LayoutView();

  public function run()
  {
    $this->layoutView->render(false, $this->loginView, $this->dateTimeView);
  }


}
