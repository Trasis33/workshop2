<?php

namespace App\Controller;

use \Core\View;
use \App\Model\User;


class Index extends \Core\Controller
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

    // $dateTime = date("l") . ', the ' . date("jS") . ' of ' . date("F Y") . ', The time is ';

    // View::render('/App/View/LayoutView.php', [
    //   'isLoggedIn'  => false,
    //   'dateTime'    => $dateTime
    // ]);
  }
  public function createAction()
  {
    $user = User::findByUsername($_POST['name']);
    var_dump($user);
  }
}