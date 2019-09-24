<?php

class RegisterView
{
  private static $message = 'RegisterView::Message';
  private static $username = 'RegisterView::UserName';
  private static $password = 'RegisterView::Password';
  private static $passwordRepeat = 'RegisterView::PasswordRepeat';
  private static $register = 'RegisterView::Register';
  private static $msg = '';

  public function response($isLoggedIn)
  {
    $response = $this->generateRegisterFormHTML(self::$msg);
    return $response;
  }

  public function generateRegisterFormHTML()
  {
    return '<h2>Register new user</h2>
    <form action="?register" method="post" enctype="multipart/form-data">
      <fieldset>
        <legend>Register a new user - Write username and password</legend>
          <p id="' . self::$message . '"> ' . self::$msg . ' </p>
          <label for="' . self::$username . '" >Username :</label>
          <input type="text" name="' . self::$username . '" id="' . self::$username . '" value="" />
          <br/>
          <label for="' . self::$password . '" >Password  :</label>
          <input type="password" name="' . self::$password . '" id="' . self::$password . '" value="" />
          <br/>
          <label for="' . self::$passwordRepeat . '" >Repeat password  :</label>
          <input type="password" name="' . self::$passwordRepeat . '" id="' . self::$passwordRepeat . '" value="" />
          <br/>
          <input id="submit" type="submit" name="' . self::$register . '"  value="Register" />
          <br/>
      </fieldset>
      ';
  }

  public function ifUserWantsToRegister()
  {
    return isset($_GET['register']);
  }
}