<?php

use App\common\Environment;
use App\routes\Router;

require './vendor/autoload.php';

Environment::load(__DIR__);

Router::execute();

// $env = getenv("DB_CONNECTION");

// print_r($env);