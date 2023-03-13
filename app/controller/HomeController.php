<?php

namespace App\controller;

class HomeController extends Controller
{
    public function index()
    {
        self::view('home');
    }
}
