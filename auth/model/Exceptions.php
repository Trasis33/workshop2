<?php

namespace model;

class UserNameTooShortException extends \Exception {}
class PasswordTooShortException extends \Exception {}
class PasswordsDidNotMatchException extends \Exception {}
class UserAlReadyExistsException extends \Exception {}
class UsernameHasInvalidCharactersException extends \Exception {}
class UsernameAndPasswordEmptyException extends \Exception {}