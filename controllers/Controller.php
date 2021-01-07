<?php


require_once __DIR__ . '/../helpers/ActivitySummary.php';
require_once __DIR__ . '/../helpers/Auth.php';

class Controller
{
    public function view($path, $p, $id = null){
        $page = $p;
        if($page=='profile'){
	        if(!Auth::isAdmin()){
	        	$disabled = 'disabled';
	        }else{
	        	$disabled = '';
	        }
        }
        $uid = $id;
        include_once __DIR__ . '/../views/' . $path;
    }
}