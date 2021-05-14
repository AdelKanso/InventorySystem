<?php

class Route
{
    public static function view($path){
        include_once __DIR__ . '/../views/' . $path;
    }

    public static function response($code, $d){
        $data =  $d;
        header('Content-type: application/json');
        http_response_code($code);
        echo json_encode( $data );
    }
}