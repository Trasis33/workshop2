<?php

//INCLUDE THE FILES NEEDED...
require_once('../App/view/LoginView.php');
require_once('../App/view/DateTimeView.php');
require_once('../App/view/LayoutView.php');

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

//CREATE OBJECTS OF THE VIEWS
$v = new LoginView();
$dtv = new DateTimeView();
$lv = new LayoutView();


$lv->render(false, $v, $dtv);

