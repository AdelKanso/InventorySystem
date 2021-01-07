<?php

require_once 'Controller.php';
require_once __DIR__ . '/../model/MachineType.php';
require_once __DIR__ . '/../helpers/ValidateParams.php';

class MachineTypeController extends Controller
{
    public static function index(){
        $page = 'table';
        self::view('layouts/app.php', $page);
    }

    public static function get(){
        $machineType = new MachineType();
        $machineTypes = $machineType->get();
        $data['data'] = $machineTypes;
        echo json_encode($data);
    }

    public static function show($id)
    {
        $machineType = new MachineType();
        $machineType = $machineType->show($id);
        if($machineType == false){
            $d = ['machineType' => ['No machine type found with this id.']];
            header('Content-type: application/json');
            http_response_code(422);
            echo json_encode($d);
        }else{
            $data['data'] = ['name' => $machineType['name'], 'consumptionRate' => $machineType['consumptionRate'],];
            header('Content-type: application/json');
            echo json_encode($data);
        }
    }

    public static function insert($data){
        $machineType = new MachineType();
        $result = true;
        $d = [];

        if($result == true){
            $machineType = $machineType->insert($data);
            if ($machineType == false) {
                $d = ['machineType' => ['There was an error inserting machine type.']];
                header('Content-type: application/json');
                http_response_code(422);
                echo json_encode($d);
            } else {
                $d = ['machineType' => ['Machine type has been successfully added.']];
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
        $machineType = new MachineType();
        $result = true;
        $d = [];

        if($result == true){
            $machineType = $machineType->update($data);
            if ($machineType == false) {
                $d = ['machineType' => ['There was an error inserting machine type.']];
                header('Content-type: application/json');
                http_response_code(422);
                echo json_encode($d);
            } else {
                $d = ['machineType' => ['Machine type has been successfully updated.']];
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
        $machineType = new MachineType();
        if($machineType->delete($id)){
            $d = ['machineType' => ['Machine type has been successfully deleted.']];
            header('Content-type: application/json');
            echo json_encode($d);
        }else{
            $d = ['machineType' => ['There was an error deleting machine type.']];
            header('Content-type: application/json');
            http_response_code(422);
            echo json_encode($d);
        }
    }
}