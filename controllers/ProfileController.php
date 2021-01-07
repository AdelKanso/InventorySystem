<?php

require_once 'Controller.php';

class ProfileController extends Controller
{
    public static function index()
    {
        $page = 'profile';
        $id = $_SESSION['id'];

        self::view('layouts/app.php', $page, $id);
    }
}