<?php
require_once __DIR__ . '/../routes/ApiRoutes.php';
require_once __DIR__ . '/../routes/WebRoutes.php';
static $section, $uri, $method, $data;
$requestURI = explode('/', $_SERVER['REQUEST_URI']);
$method = $_SERVER['REQUEST_METHOD'];
$data = $_REQUEST;
$uri = array_values($requestURI);
$section =$uri[1];
if($section == 'api'){
    ApiRoutes::invoke($uri, $data, $method);
}else if($method == 'GET'){
    WebRoutes::invoke($uri);
}