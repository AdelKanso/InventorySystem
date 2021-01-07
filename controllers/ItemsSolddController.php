<?php
require_once 'Controller.php';
require_once __DIR__ . '/../model/ItemsSoldd.php';
require_once __DIR__ . '/../model/Stock.php';
require_once __DIR__ . '/../model/Employee.php';
require_once __DIR__ . '/../model/Customer.php';
require_once __DIR__ . '/../helpers/ValidateParams.php';


class ItemsSolddController extends Controller
{
    public static function index()
    {
        $page = 'table';
        self::view('layouts/app.php', $page);
    }
    public static function get()
    {
        $soldd_item = new ItemsSoldd();
        $soldd_items = $soldd_item->get();
        foreach ($soldd_items as $soldd_item) {
            $stock = new Stock();
            $stock = $stock->show($soldd_item['stock_id']);
            $soldd_item['stock'] =  $stock;
            $customer = new Customer();
            $customer = $customer->show($soldd_item['customer_id']);
            $soldd_item['customer'] =  $customer;
            $employee = new Employee();
            $employee = $employee->show($soldd_item['employee_id']);
            $soldd_item['employee'] =  $employee;
           // $machineType = new MachineType();
           // $machineType = $machineType->show($soldd_item['machineType_id']);
            //$soldd_item['machineType'] =  $machineType;
            array_shift($soldd_items);
            array_push($soldd_items, $soldd_item);
        }

        $data['data'] = $soldd_items;
        echo json_encode($data);
    }
    public static function show($id)
    {
        $soldd_item = new ItemsSoldd();
        $soldd_item = $soldd_item->show($id);
        if ($soldd_item == false) {
            $d = ['items_soldd' => ['No stock found with this id.']];
            header('Content-type: application/json');
            http_response_code(422);
            echo json_encode($d);
        } else {
            $data['data'] = ['name' => $soldd_item['name']/*, 'machineType_id' => $soldd_item['machineType_id']*/, 'stock_id' => $soldd_item['stock_id'], 'customer_id' => $soldd_item['customer_id'], 'employee_id' => $soldd_item['employee_id'], 'price' => $soldd_item['price'], 'dos' => $soldd_item['dos']];
            header('Content-type: application/json');
            echo json_encode($data);
        }
    }
    public static function insert($data)
    {
        $soldd_item = new ItemsSoldd();
        $result = true;
        $d = [];

        if (!ValidateParams::validateInteger($data['employee_id'])) {
            $result = false;
            $d['employee_id'] = ['The employee id must be a integer value'];
        }
        if (!ValidateParams::validateInteger($data['customer_id'])) {
            $result = false;
            $d['customer_id'] = ['The customer id must be a integer value'];
        }
        if (!ValidateParams::validateInteger($data['price'])) {
            $result = false;
            $d['price'] = ['The price must be a integer value'];
        }
        if (!ValidateParams::date($data['dos'])) {
            $result = false;
            $d['dos'] = ['The date must be in valid format(Y-m-d H:i:s).'];
        }
        if ($result == true) {
            $soldd_item = $soldd_item->insert($data);
            if ($soldd_item == false) {
                $d = ['items_soldd' => ['There was an error inserting operation.']];
                header('Content-type: application/json');
                http_response_code(422);
                echo json_encode($d);
            } else {
                $d = ['items_soldd' => ['New operation has been added.']];
                header('Content-type: application/json');
                echo json_encode($d);
            }
        } else {
            header('Content-type: application/json');
            http_response_code(422);
            echo json_encode($d);
        }
    }
    public static function update($data)
    {
        $soldd_item = new ItemsSoldd();
        $result = true;
        $d = [];
        if (!ValidateParams::validateInteger($data['stock_id'])) {
            $result = false;
            $d['stock_id'] = ['The stock id must be a integer value'];
        }
        if (!ValidateParams::validateInteger($data['employee_id'])) {
            $result = false;
            $d['employee_id'] = ['The employee id must be a integer value'];
        }
        if (!ValidateParams::validateInteger($data['customer_id'])) {
            $result = false;
            $d['customer_id'] = ['The customer id must be a integer value'];
        }
        if (!ValidateParams::validateInteger($data['price'])) {
            $result = false;
            $d['price'] = ['The price must be a integer value'];
        }
        if (!ValidateParams::date($data['dos'])) {
            $result = false;
            $d['dos'] = ['The date must be in valid format(Y-m-d H:i:s).'];
        }
        if ($result == true) {
            $soldd_item = $soldd_item->update($data);
            if ($soldd_item == false) {
                $d = ['items_soldd' => ['There was an error updating content.']];
                header('Content-type: application/json');
                http_response_code(422);
                echo json_encode($d);
            } else {
                $d = ['items_soldd' => ['Operation has been successfully updated.']];
                header('Content-type: application/json');
                echo json_encode($d);
            }
        } else {
            header('Content-type: application/json');
            http_response_code(422);
            echo json_encode($d);
        }
    }
    public static function delete($id)
    {
        $soldd_item = new ItemsSoldd();
        if ($soldd_item->delete($id)) {
            $d = ['items_soldd' => ['Operation has been deleted.']];
            header('Content-type: application/json');
            echo json_encode($d);
        } else {
            $d = ['items_soldd' => ['There was an error deleting the operation,stock quantity maybe lower than the inserted value.']];
            header('Content-type: application/json');
            http_response_code(422);
            echo json_encode($d);
        }
    }
    public static function info()
    {
        $stock = new Stock();
        $stocks = $stock->getStock();
        $customer = new Customer();
        $customers = $customer->get();
        $employee = new Employee();
        $employees = $employee->get();
        $machineType = new MachineType();
        $machineTypes = $machineType->get();
        $data['data']['stocks'] = $stocks;
        $data['data']['customers'] = $customers;
        $data['data']['employees'] = $employees;
        //$data['data']['machineTypes'] = $machineTypes;
        echo json_encode($data);
    }
}
