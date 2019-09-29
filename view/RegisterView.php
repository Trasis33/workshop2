<?php

namespace view;

class RegisterView
{
  private static $messageId = 'RegisterView::Message';
  private static $username = 'RegisterView::UserName';
  private static $password = 'RegisterView::Password';
  private static $passwordRepeat = 'RegisterView::PasswordRepeat';
  private static $register = 'RegisterView::Register';

  private $msg = '';
  private $name;

  public function response($isLoggedIn)
  {
    $response = $this->generateRegistrationFormHTML($this->msg);
    return $response;
  }

  public function generateRegistrationFormHTML($message)
  {
    return '<h2>Register new user</h2>
    <form method="post">
      <fieldset>
        <legend>Register a new user - Write username and password</legend>
          <p id="' . self::$messageId . '"> ' . $message . ' </p>
          <label for="' . self::$username . '" >Username :</label>
          <input type="text" name="' . self::$username . '" id="' . self::$username . '" value="' . $this->name . '" />
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
  private function fieldHasUsername()
  {
		return isset($_POST[self::$username]) && !empty($_POST[self::$username]);
  }

  private function fieldHasPassword()
  {
		return isset($_POST[self::$password]) && !empty($_POST[self::$password]);
  }

  private function fieldHasPasswordRepeat()
  {
		return isset($_POST[self::$passwordRepeat]) && !empty($_POST[self::$passwordRepeat]);
  }

  public function getUsername()
  {
		return $_POST[self::$username];
  }

  public function getPassword()
  {
		return $_POST[self::$password];
  }

  public function getPasswordRepeat()
  {
		return $_POST[self::$passwordRepeat];
  }

  public function checkIfPasswordsMatch()
  {
		return $this->getPassword() == $this->getPasswordRepeat();
  }

  public function setMessage($message)
  {
		$this->msg = $message;
  }

  public function ifUserWantsToRegister()
  {
    if($this->ifUserPressedRegister())
    {
			$this->messageIfFieldsAreEmpty();
			$this->name = $this->getUsername();
		}

		if($this->ifUserPressedRegister() && $this->fieldHasUsername() && $this->fieldHasPassword() && $this->fieldHasPasswordRepeat()) {
			return true;
		} else {
			return false;
		}
	}

  public function ifUserPressedRegister()
  {
    return isset($_POST[self::$register]);
  }

  private function messageIfFieldsAreEmpty()
  {
    if(!$this->fieldHasUsername() && !$this->fieldHasPassword())
    {
			$this->setMessage("Username has too few characters, at least 3 characters. <br> Password has too few characters, at least 6 characters.");
    } else if(!$this->fieldHasUsername())
    {
			$this->setMessage("Username has too few characters, at least 3 characters.");
    } else if(!$this->fieldHasPassword())
    {
			$this->setMessage("Password has too few characters, at least 6 characters.");
    } else if(!$this->fieldHasPasswordRepeat())
    {
			$this->setMessage("Password has too few characters, at least 6 characters.");
		}
  }

  public function getRegisterUserCredentials()
  {
    if($this->fieldHasUsername() && $this->fieldHasPassword() && $this->fieldHasPasswordRepeat())
    {
			$username = $this->getUsername();
			$password = $this->getPassword();
			$passwordRepeat = $this->getPasswordRepeat();

			return new \model\SignupCredentials($username, $password, $passwordRepeat);
		}
	}

}