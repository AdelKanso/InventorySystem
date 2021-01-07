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
         if($_SESSION['admin'] == 1)
            return true;
        return false;   	
    }
}