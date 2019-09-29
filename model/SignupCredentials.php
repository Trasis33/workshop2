<?php

namespace model;

class SignupCredentials
{
    private $userName;
    private $password;
    private $repeatPassword;

    const MIN_USERNAME_LENGTH = 3;
    const MIN_PASSWORD_LENGTH = 6;

    public function __construct(string $userName, string $password, string $repeatPassword)
    {
        $this->userName = $this->applyFilter($userName);
        $this->password = $this->applyFilter($password);
        $this->repeatPassword = $this->applyFilter($repeatPassword);

        if(strlen($this->userName) < self::MIN_USERNAME_LENGTH)
        {
            throw new UserNameTooShortException("Username has too few characters, at least 3 characters.");
        }
        if(strlen($this->password) < self::MIN_PASSWORD_LENGTH)
        {
            throw new PasswordTooShortException("Password has too few characters, at least 6 characters.");
        }
        if(!$this->passwordMatch())
        {
            throw new PasswordsDidNotMatchException("Passwords do not match.");
        }
    }

    public function getUserName()
    {
        return $this->userName;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getRepeatPassword()
    {
        return $this->repeatPassword;
    }

    private function passwordMatch()
    {
      $password = $this->getPassword();
      $repeatPassword = $this->getRepeatPassword();

      if($password == $repeatPassword)
      {
        return true;
      } else
      {
        return false;
      }
    }

    public static function applyFilter(string $rawInput)
    {
      return trim(htmlentities($rawInput));
    }
}