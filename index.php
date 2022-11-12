<?php

session_start();

define('ROOT', dirname(__FILE__));

use App\Services\App;

require_once __DIR__ . '/vendor/autoload.php';
App::start();
require_once __DIR__ . '/router/routes.php';




