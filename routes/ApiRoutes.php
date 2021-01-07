<?php


require_once __DIR__ . '/../routes/Route.php';
require_once __DIR__ . '/../routes/ValidateRoutes.php';
require_once __DIR__ . '/../controllers/LoginController.php';
require_once __DIR__ . '/../controllers/TableController.php';
require_once __DIR__ . '/../controllers/UserController.php';
require_once __DIR__ . '/../controllers/EmployeeController.php';
require_once __DIR__ . '/../controllers/ProductController.php';
require_once __DIR__ . '/../controllers/StockController.php';
require_once __DIR__ . '/../controllers/ItemsSoldController.php';
require_once __DIR__ . '/../controllers/ItemsSolddController.php';
require_once __DIR__ . '/../controllers/MachineTypeController.php';
require_once __DIR__ . '/../controllers/MachineConsumableController.php';
require_once __DIR__ . '/../controllers/CalendarController.php';


class ApiRoutes extends Route
{
    private static $data, $method;
    public static function invoke($uri, $data, $method)
    {
        self::$method = $method;
        if ($method == "PATCH") {
            parse_str(file_get_contents('php://input'), self::$data);
        } else {
            self::$data = $data;
        }
        $arr = explode("?", $uri[2], 2);
        $section = $arr[0];
        if (!ValidateRoutes::apiValidate($section))
            self::view("layouts/error.php");
        else
            self::findController($section);
    }

    static function findController($section)
    {
        switch ($section) {
            case 'login':
                if (self::$method == 'POST')
                    LoginController::login(self::$data);
                else
                    self::response(404, ["message" => "Page not found!"]);
                break;
            case 'users':
                if (self::$method == 'GET')
                    UserController::get();
                else if (self::$method == 'POST')
                    if (isset(self::$data['table']))
                        UserController::insert(self::$data);
                    else
                        UserController::showByEmployee(self::$data['employee_id']);
                else if (self::$method == 'PATCH')
                    if (isset(self::$data['profile']))
                        UserController::update(self::$data, self::$data['profile']);
                    else
                        UserController::update(self::$data);
                else if (self::$method == 'DELETE')
                    UserController::delete(self::$data['id']);
                else
                    self::response(404, ["message" => "Page not found!"]);
                break;
            case 'employees':
                if (self::$method == 'GET')
                    EmployeeController::get();
                else if (self::$method == 'POST') {
                    if (isset(self::$data['table']))
                        EmployeeController::insert(self::$data);
                    else
                        EmployeeController::show(self::$data['employee_id']);
                } else if (self::$method == 'PATCH')
                    EmployeeController::update(self::$data);
                else if (self::$method == 'DELETE')
                    EmployeeController::delete(self::$data['id']);
                else
                    self::response(404, ["message" => "Page not found!"]);
                break;
            case 'customers':
                if (self::$method == 'GET') {
                    CustomerController::get();
                } else if (self::$method == 'GETLATEST') {
                    CustomerController::getLatest();
                } else if (self::$method == 'POST')
                    CustomerController::insert(self::$data);
                else if (self::$method == 'PATCH')
                    CustomerController::update(self::$data);
                else if (self::$method == 'DELETE')
                    CustomerController::delete(self::$data['id']);
                else
                    self::response(404, ["message" => "Page not found!"]);
                break;
            case 'merchants':
                if (self::$method == 'GET')
                    MerchantController::get();
                else if (self::$method == 'POST')
                    MerchantController::insert(self::$data);
                else if (self::$method == 'PATCH')
                    MerchantController::update(self::$data);
                else if (self::$method == 'DELETE')
                    MerchantController::delete(self::$data['id']);
                else
                    self::response(404, ["message" => "Page not found!"]);
                break;
            case 'products':
                if (self::$method == 'GET')
                    ProductController::get();
                else if (self::$method == 'POST')
                    ProductController::insert(self::$data);
                else if (self::$method == 'PATCH')
                    ProductController::update(self::$data);
                else if (self::$method == 'DELETE')
                    ProductController::delete(self::$data['id']);
                else
                    self::response(404, ["message" => "Page not found!"]);
                break;
            case 'stocks':
                if (self::$method == 'GET')
                    StockController::get();
                else if (self::$method == 'POST')
                    StockController::insert(self::$data);
                else if (self::$method == 'PATCH')
                    StockController::update(self::$data);
                else if (self::$method == 'DELETE')
                    StockController::delete(self::$data['id']);
                else
                    self::response(404, ["message" => "Page not found!"]);
                break;
            case 'machineType':
                if (self::$method == 'GET')
                    MachineTypeController::get();
                else if (self::$method == 'POST')
                    MachineTypeController::insert(self::$data);
                else if (self::$method == 'PATCH')
                    MachineTypeController::update(self::$data);
                else if (self::$method == 'DELETE')
                    MachineTypeController::delete(self::$data['id']);
                else
                    self::response(404, ["message" => "Page not found!"]);
                break;
            case 'machineConsumable':
                if (self::$method == 'GET')
                    MachineConsumableController::get();
                else if (self::$method == 'POST')
                    MachineConsumableController::insert(self::$data);
                else if (self::$method == 'PATCH')
                    MachineConsumableController::update(self::$data);
                else if (self::$method == 'DELETE')
                    MachineConsumableController::delete(self::$data['id']);
                else
                    self::response(404, ["message" => "Page not found!"]);
                break;
            case 'stockInfo':
                if (self::$method == 'GET')
                    StockController::info();
                else
                    self::response(404, ["message" => "Page not found!"]);
                break;
            case 'machineConsumableInfo':
                if (self::$method == 'GET')
                    MachineConsumable::info();
                else
                    self::response(404, ["message" => "Page not found!"]);
                break;
            case 'items_sold':
                if (self::$method == 'GET')
                    ItemsSoldController::get();
                else if (self::$method == 'POST')
                    ItemsSoldController::insert(self::$data);
                else if (self::$method == 'PATCH')
                    ItemsSoldController::update(self::$data);
                else if (self::$method == 'DELETE')
                    ItemsSoldController::delete(self::$data['id']);
                else
                    self::response(404, ["message" => "Page not found!"]);
                break;
            case 'items_soldd':
                if (self::$method == 'GET')
                    ItemsSolddController::get();
                else if (self::$method == 'POST')
                    ItemsSolddController::insert(self::$data);
                else if (self::$method == 'PATCH')
                    ItemsSolddController::update(self::$data);
                else if (self::$method == 'DELETE')
                    ItemsSolddController::delete(self::$data['id']);
                else
                    self::response(404, ["message" => "Page not found!"]);
                break;
            case 'calendar':
                if (self::$method == 'POST') {
                    CalendarController::insert(self::$data);
                } else if (self::$method == 'DELETE') {
                    parse_str(file_get_contents('php://input'), self::$data);
                    CalendarController::delete(self::$data['dayy'], self::$data['monthh'], self::$data['description']);
                } else
                    self::response(404, ["message" => "Page not found!"]);
                break;
            case 'items_sold_info':
                if (self::$method == 'GET')
                    ItemsSoldController::info();
                else
                    self::response(404, ["message" => "Page not found!"]);
                break;
            case 'items_soldd_info':
                if (self::$method == 'GET')
                    ItemsSolddController::info();
                else
                    self::response(404, ["message" => "Page not found!"]);
                break;
            case 'print':
                if (self::$method == 'GET')
                    PrintController::get();
                else if (self::$method == 'PATCH')
                    PrintController::getById(self::$data);
                else
                    self::response(404, ["message" => "Page not found!"]);
                break;
            case 'printt':
                if (self::$method == 'GET')
                    PrintController::get();
                else if (self::$method == 'PATCH')
                PrintController::getByIdd(self::$data);
                else
                    self::response(404, ["message" => "Page not found!"]);
                break;
            case 'tables':
                if (self::$method == 'GET')
                    TableController::count();
                else
                    self::response(404, ["message" => "Page not found!"]);
                break;
        }
    }
}
