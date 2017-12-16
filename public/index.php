<?php
define('ROOT', dirname(__DIR__));
require ROOT.'/app/App.php';


//TODO question
//App::load()
App::getInstance()->load();

//start the session if it is not started automatically by the server
if (!isset($_SESSION)) {
    session_start();
}

App::getInstance()->router();