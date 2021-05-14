<?php

class Auth
{
    public static function userLogged(){
        session_start();
        if(isset($_SESSION['username']))
            return true;
        return false;
    }
    public static function isAdmin(){
         if($_SESSION['role'] == 'admin')
            return true;
        return false;   	
    }
}