<?php

namespace model;

class UserName
{
  const MIN_NAME_LENGTH = 3;
  private $name = null;

  public function __construct(string $newName) {

    $this->name = $this->applyFilter($newName);

		if (strlen($this->name) < self::$minNameLength) {
			throw new TooShortNameException();
		}
  }

  public function setName(UserName $newName) {
		$this->name = $newName->getUserName();
	}
	public function getUserName() {
		return $this->name;
	}
	public function hasUserName() : bool {
		return $this->name != null;
	}

  public static function applyFilter(string $rawInput) : string {
		return trim(htmlentities($rawInput));
	}
}