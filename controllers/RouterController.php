<?php
require_once 'Controller.php';
require_once __DIR__ . '/../model/Router.php';
require_once __DIR__ . '/../model/Stock.php';
require_once __DIR__ . '/../model/Employee.php';
require_once __DIR__ . '/../model/Customer.php';
require_once __DIR__ . '/../helpers/ValidateParams.php';


class RouterController extends Controller
{
    public static function index()
    {
        $page = 'table';
        self::view('layouts/app.php', $page);
    }
    public static function get()
    {
        $router = new Router();
        $routers = $router->get();
        foreach ($routers as $router) {
            $stock = new Stock();
            $stock = $stock->show($router['stock_id']);
            $router['stock'] =  $stock;
            $customer = new Customer();
            $customer = $customer->show($router['customer_id']);
            $router['customer'] =  $customer;
            $employee = new Employee();
            $employee = $employee->show($router['employee_id']);
            $router['employee'] =  $employee;
            array_shift($routers);
            array_push($routers, $router);
        }

        $data['data'] = $routers;
        echo json_encode($data);
    }
    public static function show($id)
    {
        $router = new Router();
        $router = $router->show($id);
        if ($router == false) {
            $d = ['items_soldd' => ['No stock found with this id.']];
            header('Content-type: application/json');
            http_response_code(422);
            echo json_encode($d);
        } else {
            $data['data'] = ['name' => $router['name'], 'stock_id' => $router['stock_id'], 'customer_id' => $router['customer_id'], 'employee_id' => $router['employee_id'], 'price' => $router['price'], 'dos' => $router['dos']];
            header('Content-type: application/json');
            echo json_encode($data);
        }
    }
    public static function insert($data)
    {
        $router = new Router();
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
        if (!ValidateParams::validateInteger($data['fuelPrice'])) {
            $result = false;
            $d['stock_id'] = ['The fuel cost must be a integer value'];
        }
        if ($result == true) {
            $router = $router->insert($data);
            if ($router == false) {
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
        $router = new Router();
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
        if (!ValidateParams::validateInteger($data['fuelPrice'])) {
            $result = false;
            $d['stock_id'] = ['The fuel cost must be a integer value'];
        }
        if ($result == true) {
            $router = $router->update($data);
            if ($router == false) {
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
        $router = new Router();
        if ($router->delete($id)) {
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
        echo json_encode($data);
    }
}
