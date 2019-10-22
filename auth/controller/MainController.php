<?php

namespace auth\controller;

require_once('auth/view/LoginView.php');
require_once('auth/view/RegisterView.php');
require_once('auth/view/DateTimeView.php');
require_once('auth/view/LayoutView.php');

require_once('auth/model/LoginModel.php');
require_once('auth/model/UserCredentials.php');
require_once('auth/model/SignupCredentials.php');
require_once('auth/model/Exceptions.php');
require_once('auth/model/UserStorage.php');

require_once('auth/controller/LoginController.php');
require_once('auth/controller/SignupController.php');

class MainController
{
    private $loginView;
    private $registerView;
    private $dateTimeView;
    private $layoutView;

    private $loginModel;

    private $loginController;
    private $signupController;

    private $userStorage;

    public function __construct()
    {
        $this->loginView = new \view\LoginView();
        $this->registerView = new \view\RegisterView();
        $this->dateTimeView = new \view\DateTimeView();
        $this->layoutView = new \view\LayoutView();

        $this->userStorage = new \model\UserStorage();

        $this->loginModel = new \model\LoginModel();

        $this->loginController = new \controller\LoginController($this->loginView, $this->loginModel, $this->userStorage);
        $this->signupController = new \controller\SignupController($this->registerView, $this->loginModel);
    }

    public function run()
    {
        $this->changeState();
        $this->output();
    }
    private function changeState()
    {
        $userSession = $this->userStorage->loadUser();

        if ($userSession) {
            $this->loginModel->setIsLoggedIn(true);
        }

        if ($this->loginModel->getIsLoggedIn()) {
            if ($this->loginView->ifUserWantsToLogout()) {
                $this->loginController->logout();
            }
        } else {
            if ($this->registerView->ifUserWantsToRegister()) {
                $this->signupController->register();
            } else if ($this->loginView->ifUserWantsToLogin()) {
                $this->loginModel->setIsLoggedIn($this->loginController->login());
            }
        }
    }
    private function output()
    {
        if ($this->layoutView->userHasClickedRegister()) {
            return $this->layoutView->render($this->loginModel->getIsLoggedIn(), $this->registerView, $this->dateTimeView);
        } else {
            return $this->layoutView->render($this->loginModel->getIsLoggedIn(), $this->loginView, $this->dateTimeView);
        }
    }
}
