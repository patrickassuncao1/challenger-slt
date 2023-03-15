<?php

use App\common\Environment;
use App\routes\Router;

session_start();
require './vendor/autoload.php';

Environment::load(__DIR__);

Router::execute();
