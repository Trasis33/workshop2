<?php

namespace view;

class LoginView {
	private static $login = 'LoginView::Login';
	private static $logout = 'LoginView::Logout';
	private static $name = 'LoginView::UserName';
	private static $password = 'LoginView::Password';
	private static $cookieName = 'LoginView::CookieName';
	private static $cookiePassword = 'LoginView::CookiePassword';
	private static $keep = 'LoginView::KeepMeLoggedIn';
	private static $messageId = 'LoginView::Message';

  private $message;

	public function __construct()
	{
	}

	/**
	 * Create HTTP response
	 *
	 * Should be called after a login attempt has been determined
	 *
	 * @return  void BUT writes to standard output and cookies!
	 */
	public function response($isLoggedIn) {

    if (!$isLoggedIn) {
      $response = $this->generateLoginFormHTML($this->message);
    } else {
      $response = $this->generateLogoutButtonHTML($this->message);
    }
    return $response;
	}

  public function setMessage($message)
  {
    $this->message = $message;
  }

	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLogoutButtonHTML($message) {
		return '
			<form  method="post" >
				<p id="' . self::$messageId . '">' . $message .'</p>
				<input type="submit" name="' . self::$logout . '" value="logout"/>
			</form>
		';
	}

	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLoginFormHTML($message) {
		return '
			<form method="post" >
				<fieldset>
					<legend>Login - enter Username and password</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>

					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="" />

					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />

					<label for="' . self::$keep . '">Keep me logged in  :</label>
					<input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />

					<input type="submit" name="' . self::$login . '" value="login" />
				</fieldset>
			</form>
		';
	}

	//CREATE GET-FUNCTIONS TO FETCH REQUEST VARIABLES

  private function fieldHasUsername()
  {
		return isset($_POST[self::$name]) && !empty($_POST[self::$name]);
  }

  private function fieldHasPassword()
  {
		return isset($_POST[self::$password]) && !empty($_POST[self::$password]);
  }

  public function getUserName()
  {
		return $_POST[self::$name];
	}

  public function getPassword()
  {
		return $_POST[self::$password];
  }

  public function getKeepLoggedIn() : bool
  {
		return isset($_POST[self::$keep]);
  }

  private function userPressedLogin()
  {
		return isset($_POST[self::$login]);
  }

  private function userPressedLogout()
  {
		return isset($_POST[self::$logout]);
	}

  private function messageIfFieldsAreEmpty()
  {
    if(!$this->fieldHasPassword())
    {
      $this->setMessage("Password is missing");
    }
    if(!$this->fieldHasUsername())
    {
      $this->setMessage("Username is missing");
    }
  }

  public function ifUserWantsToLogin()
  {
    if($this->userPressedLogin())
    {
      $this->messageIfFieldsAreEmpty();
    }

    if ($this->userPressedLogin() && $this->fieldHasUsername() && $this->fieldHasPassword())
    {
      return true;
    } else
    {
      return false;
    }
  }

  public function ifUserWantsToLogout()
  {
    if($this->userPressedLogout())
    {
      return true;
    } else
    {
      return false;
    }
  }

  public function getUserCredentials()
  {
    if($this->fieldHasUsername() && $this->fieldHasPassword())
    {
      $username = $this->getUserName();
      $password = $this->getPassword();
      $keepLoggedIn = $this->getKeepLoggedIn();

      return new \model\UserCredentials($username, $password, $keepLoggedIn);
    }
  }
}