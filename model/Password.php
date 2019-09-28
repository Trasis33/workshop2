<?php

namespace model;

use Exception;

class Password
{
  private $password;
  const MIN_PASSWORD_LENGTH = 6;

  public function __construct(string $password)
  {
    $this->passwordTooShortHandler($password);

    $this->password = $password;
  }

  public function setPassword(string $password) {
    $this->password = $password;
  }

  public function getPassword() {
    return $this->password;
  }
  private function isPasswordTooShort(string $password) {
    if (strlen($password) < self::MIN_PASSWORD_LENGTH) {
      return true;
    }
    return false;
  }

  private function passwordTooShortHandler(string $password) {
    if ($this->isPasswordTooShort($password)) {
      throw new Exception("Password has too few characters, at least " . self::MIN_PASSWORD_LENGTH . " characters.")
    }
  }
}
