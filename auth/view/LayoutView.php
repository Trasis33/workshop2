<?php

namespace view;

class LayoutView{

  public function render($isLoggedIn, $v, DateTimeView $dtv) {
    echo '<!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title>Login Example</title>
        </head>
        <body>
          <h1>Assignment 2</h1>
          ' . $this->renderRegisterLink($isLoggedIn) . '
          ' . $this->renderIsLoggedIn($isLoggedIn) . '

          <div class="container">
              ' . $v->response($isLoggedIn) . '

              ' . $dtv->show() . '
          </div>
         </body>
      </html>
    ';
  }

  private function renderIsLoggedIn($isLoggedIn) {
    if ($isLoggedIn) {
      return '<h2>Logged in</h2>';
    }
    else {
      return '<h2>Not logged in</h2>';
    }
  }

  private function renderRegisterLink($isLoggedIn)
  {
    $ret = '';
    if(!$isLoggedIn)
    {
      $ret = '<a href="?register">Register a new user</a>';
    }
    if(!$isLoggedIn && $this->userHasClickedRegister())
    {
      $ret = '<a href="./">Back to login</a>';
    }
    return $ret;
  }

  public function userHasClickedRegister()
  {
    if(isset($_GET["register"]))
    {
      return true;
    } else
    {
      return false;
    }
  }
}


