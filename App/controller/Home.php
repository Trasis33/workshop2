<?php

namespace App\Controller;

use \Core\View;
use \App\Model\User;


class Home extends \Core\Controller
{

  protected function before()
  {

  }

  protected function after()
  {

  }

  public function indexAction()
  {
    // View::render('Home/index.php');
    $dateTime = date("l") . ', the ' . date("jS") . ' of ' . date("F Y") . ', The time is ';

    View::renderTemplate('Home/index.html', [
      'isLoggedIn'  => false,
      'dateTime'    => $dateTime
    ]);
  }
  public function createAction()
  {
    $user = User::findByUsername($_POST['name']);
    var_dump($user);
  }
}