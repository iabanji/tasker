<?php
session_start();

require(__DIR__ . '/app/core/Autoloader.php'); 

$config = require(__DIR__ . '/app/config/app.php');

app\core\Application::setConfig($config);
exit();
$instance = app\core\Application::getInstance();

app\core\FrontController::run();