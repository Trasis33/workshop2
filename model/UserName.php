<?php

namespace model;

use Exception;

class Username
{
  const MIN_NAME_LENGTH = 3;
  private $username = null;

  public function __construct(string $username) {
    $this->usernameTooShortHandler($username);

    $this->username = $username;
  }

  public function setUsername(string $username) {
		$this->username = $username;
	}
	public function getUserName() {
		return $this->username;
	}
	public function hasUserName() : bool {
		return $this->username != null;
  }

  private function isUsernameTooShort(string $username)
  {
    if (empty($username) || strlen($username) < self::MIN_NAME_LENGTH)
    {
      return true;
    }
    return false;
  }

  private function usernameTooShortHandler(string $username)
  {
    if ($this->isUsernameTooShort($username)) {
      throw new Exception("Username has too few characters, at least " . self::MIN_NAME_LENGTH . " characters.");
    }
  }
}