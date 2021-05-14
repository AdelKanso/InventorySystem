<?php

require_once 'Controller.php';
require_once __DIR__ . '/../model/RawMaterial.php';
require_once __DIR__ . '/../helpers/ValidateParams.php';

class RawMaterialController extends Controller
{
    public static function index(){
        $page = 'table';
        self::view('layouts/app.php', $page);
    }

    public static function get(){
        $rawMaterial = new RawMaterial();
        $rawMaterials = $rawMaterial->get();
        $data['data'] = $rawMaterials;
        echo json_encode($data);
    }

    public static function show($id)
    {
        $rawMaterial = new RawMaterial();
        $rawMaterial = $rawMaterial->show($id);
        if($rawMaterial == false){
            $d = ['rawMaterial' => ['No rawMaterial found with this id.']];
            header('Content-type: application/json');
            http_response_code(422);
            echo json_encode($d);
        }else{
            $data['data'] = ['name' => $rawMaterial['name'], 'subtype' => $rawMaterial['subtype'],];
            header('Content-type: application/json');
            echo json_encode($data);
        }
    }

    public static function insert($data){
        $rawMaterial = new RawMaterial();
        $result = true;
        $d = [];

        if($result == true){
            $rawMaterial = $rawMaterial->insert($data);
            if ($rawMaterial == false) {
                $d = ['rawMaterial' => ['There was an error inserting rawMaterial.']];
                header('Content-type: application/json');
                http_response_code(422);
                echo json_encode($d);
            } else {
                $d = ['rawMaterial' => ['RawMaterial has been successfully added.']];
                header('Content-type: application/json');
                echo json_encode($d);
            }
        }else{
            header('Content-type: application/json');
            http_response_code(422);
            echo json_encode($d);
        }
    }

    public static function update($data){
        $rawMaterial = new RawMaterial();
        $result = true;
        $d = [];

        if($result == true){
            $rawMaterial = $rawMaterial->update($data);
            if ($rawMaterial == false) {
                $d = ['rawMaterial' => ['There was an error inserting rawMaterial.']];
                header('Content-type: application/json');
                http_response_code(422);
                echo json_encode($d);
            } else {
                $d = ['rawMaterial' => ['RawMaterial has been successfully updated.']];
                header('Content-type: application/json');
                echo json_encode($d);
            }
        }else{
            header('Content-type: application/json');
            http_response_code(422);
            echo json_encode($d);
        }
    }

    public static function delete($id){
        $rawMaterial = new RawMaterial();
        if($rawMaterial->delete($id)){
            $d = ['rawMaterial' => ['RawMaterial has been successfully deleted.']];
            header('Content-type: application/json');
            echo json_encode($d);
        }else{
            $d = ['rawMaterial' => ['There was an error deleting rawMaterial.']];
            header('Content-type: application/json');
            http_response_code(422);
            echo json_encode($d);
        }
    }
}