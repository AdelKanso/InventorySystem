<?php
require_once 'Controller.php';
require_once __DIR__ . '/../model/Plasma.php';
require_once __DIR__ . '/../model/Stock.php';
require_once __DIR__ . '/../model/Employee.php';
require_once __DIR__ . '/../model/Customer.php';
require_once __DIR__ . '/../helpers/ValidateParams.php';


class PlasmaController extends Controller
{
    public static function index()
    {
        $page = 'table';
        self::view('layouts/app.php', $page);
    }
    public static function get()
    {
        $plasma = new Plasma();
        $plasmas = $plasma->get();
        foreach ($plasmas as $plasma) {
            $stock = new Stock();
            $stock = $stock->show($plasma['stock_id']);
            $plasma['stock'] =  $stock;
            $customer = new Customer();
            $customer = $customer->show($plasma['customer_id']);
            $plasma['customer'] =  $customer;
            $employee = new Employee();
            $employee = $employee->show($plasma['employee_id']);
            $plasma['employee'] =  $employee;
            array_shift($plasmas);
            array_push($plasmas, $plasma);
        }

        $data['data'] = $plasmas;
        echo json_encode($data);
    }
    public static function show($id)
    {
        $plasma = new Plasma();
        $plasma = $plasma->show($id);
        if ($plasma == false) {
            $d = ['items_sold' => ['No stock found with this id.']];
            header('Content-type: application/json');
            http_response_code(422);
            echo json_encode($d);
        } else {
            $data['data'] = ['name' => $plasma['name'], 'stock_id' => $plasma['stock_id'], 'customer_id' => $plasma['customer_id'], 'employee_id' => $plasma['employee_id'], 'price' => $plasma['price'], 'dos' => $plasma['dos']];
            header('Content-type: application/json');
            echo json_encode($data);
        }
    }
    public static function insert($data)
    {
        $plasma = new Plasma();
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
            $plasma = $plasma->insert($data);
            if ($plasma == false) {
                $d = ['items_sold' => ['There was an error inserting operation.']];
                header('Content-type: application/json');
                http_response_code(422);
                echo json_encode($d);
            } else {
                $d = ['items_sold' => ['New operation has been added.']];
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
        $plasma = new Plasma();
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
            $plasma = $plasma->update($data);
            if ($plasma == false) {
                $d = ['items_sold' => ['There was an error updating content.']];
                header('Content-type: application/json');
                http_response_code(422);
                echo json_encode($d);
            } else {
                $d = ['items_sold' => ['Operation has been successfully updated.']];
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
        $plasma = new Plasma();
        if ($plasma->delete($id)) {
            $d = ['items_sold' => ['Operation has been deleted.']];
            header('Content-type: application/json');
            echo json_encode($d);
        } else {
            $d = ['items_sold' => ['There was an error deleting the operation,stock quantity maybe lower than the inserted value.']];
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
        $data['data']['stocks'] = $stocks;
        $data['data']['customers'] = $customers;
        $data['data']['employees'] = $employees;
        echo json_encode($data);
    }
}
