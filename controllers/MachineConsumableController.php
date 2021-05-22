<?php

require_once 'Controller.php';
require_once __DIR__ . '/../model/MachineConsumable.php';
require_once __DIR__ . '/../helpers/ValidateParams.php';

class MachineConsumableController extends Controller
{
    public static function index(){
        $page = 'table';
        self::view('layouts/app.php', $page);
    }

    public static function get(){
        $machineConsumable = new MachineConsumable();
        $machineConsumables = $machineConsumable->get();
        foreach ($machineConsumables as $machineConsumable) {
            $machineType = new MachineType();
            $machineType = $machineType->show($machineConsumable['machineType_id']);
            $machineConsumable['machineType'] =  $machineType;
            array_shift($machineConsumables);
            array_push($machineConsumables, $machineConsumable);
        }
        $data['data'] = $machineConsumables;
        echo json_encode($data);

    }

    public static function show($id)
    {
        $machineConsumable = new MachineConsumable();
        $machineConsumable = $machineConsumable->show($id);
        if($machineConsumable == false){
            $d = ['machineConsumable' => ['No machine consumable found with this id.']];
            header('Content-type: application/json');
            http_response_code(422);
            echo json_encode($d);
        }else{
            $data['data'] = [ 'machineType_id' => $machineConsumable['machineType_id'],'name' => $machineConsumable['name'], 'serialNumber' => $machineConsumable['serialNumber'],'quantity' => $machineConsumable['quantity'],'description' => $machineConsumable['description'],'price' => $machineConsumable['price'],];
            header('Content-type: application/json');
            echo json_encode($data);
        }
    }

    public static function nearOfStock()
    {
        $machineConsumable = new MachineConsumable();
        $machineConsumables = $machineConsumable->nearOutOfStock();
        $data['data'] =$machineConsumables;
        echo json_encode($data);
    }

    public static function insert($data){
        $machineConsumable = new MachineConsumable();
        $result = true;
        $d = [];
        if (!ValidateParams::name($data['name'])) {
            $result = false;
            $d['name'] = ['The name must be a valid string and it\'s length must not be greater than 70 chars.'];
        }
        if (!ValidateParams::isEmpty($data['name'])) {
            $result = false;
            $d['name'] = ['The name cannot be empty'];
        }
        if (!ValidateParams::validateInteger($data['quantity'])) {
            $result = false;
            $d['quantity'] = ['The quantity must contain a value.'];
        }
        if (!ValidateParams::isEmpty($data['price'])) {
            $result = false;
            $d['price'] = ['The price must contain a value.'];
        }
        if($result == true){
            $machineConsumable = $machineConsumable->insert($data);
            if ($machineConsumable == false) {
                $d = ['machineConsumable' => ['There was an error inserting machine consumable.']];
                header('Content-type: application/json');
                http_response_code(422);
                echo json_encode($d);
            } else {
                $d = ['machineConsumable' => ['Machine consumable has been successfully added.']];
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
        $machineConsumable = new MachineConsumable();
        $result = true;
        $d = [];
        if (!ValidateParams::name($data['name'])) {
            $result = false;
            $d['name'] = ['The name must be a valid string and it\'s length must not be greater than 70 chars.'];
        }
        if (!ValidateParams::isEmpty($data['name'])) {
            $result = false;
            $d['name'] = ['The name cannot be empty'];
        }
        if (!ValidateParams::validateInteger($data['quantity'])) {
            $result = false;
            $d['quantity'] = ['The quantity must contain a value.'];
        }
        if (!ValidateParams::isEmpty($data['price'])) {
            $result = false;
            $d['price'] = ['The price must contain a value.'];
        }
        if($result == true){
            $machineConsumable = $machineConsumable->update($data);
            if ($machineConsumable == false) {
                $d = ['machineConsumable' => ['There was an error inserting machine consumable.']];
                header('Content-type: application/json');
                http_response_code(422);
                echo json_encode($d);
            } else {
                $d = ['machineConsumable' => ['Machine consumable has been successfully updated.']];
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
        $machineConsumable = new MachineConsumable();
        if($machineConsumable->delete($id)){
            $d = ['machineConsumable' => ['Machine consumable has been successfully deleted.']];
            header('Content-type: application/json');
            echo json_encode($d);
        }else{
            $d = ['machineConsumable' => ['There was an error deleting machine consumable.']];
            header('Content-type: application/json');
            http_response_code(422);
            echo json_encode($d);
        }
    }
}