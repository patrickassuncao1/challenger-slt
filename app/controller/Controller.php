<?php

namespace App\controller;

use App\helpers\Response;
use League\Plates\Engine;

abstract class Controller
{
    public function view(string $view, $data = [], int $status = 200)
    {
        $pathViews = dirname(__FILE__, 3);

        $templates = new Engine("{$pathViews}/view/");

        return new Response($status, $templates->render($view, $data));
    }
}