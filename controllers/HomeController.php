<?php

require_once 'Controller.php';

class HomeController extends Controller
{
    public static function index()
    {
        $page = 'home';
        self::view('layouts/app.php', $page);
    }
}