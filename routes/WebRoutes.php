<?php

require_once 'Route.php';
require_once __DIR__ . '/../routes/ValidateRoutes.php';
require_once __DIR__ . '/../helpers/Auth.php';
require_once __DIR__ . '/../controllers/HomeController.php';
require_once __DIR__ . '/../controllers/PrintController.php';
require_once __DIR__ . '/../controllers/LoginController.php';
require_once __DIR__ . '/../controllers/ProfileController.php';
require_once __DIR__ . '/../controllers/CustomerController.php';
require_once __DIR__ . '/../controllers/StockController.php';
require_once __DIR__ . '/../controllers/RawMaterialController.php';
require_once __DIR__ . '/../controllers/TableController.php';
require_once __DIR__ . '/../controllers/MerchantController.php';
require_once __DIR__ . '/../controllers/PlasmaController.php';
require_once __DIR__ . '/../controllers/RouterController.php';
require_once __DIR__ . '/../controllers/MachineTypeController.php';
require_once __DIR__ . '/../controllers/MachineConsumableController.php';

class WebRoutes extends Route
{

    public static function invoke($uri)
    {
        $loggedIn = Auth::userLogged();
        if (!ValidateRoutes::webValidate($uri)){
            self::view("layouts/error.php");
        }
        else {
            if (!$loggedIn && $uri[1] == 'login')
                LoginController::index();
            else {
                if (!$loggedIn)
                    header('Location: /login');
                else
                    self::findController($uri[1]);
            }
        }
    }

    static function findController($section)
    {
        switch ($section) {
            case 'customers':
                CustomerController::index();
                break;
            case 'employees':
                if (Auth::isAdmin()) {
                    EmployeeController::index();
                    break;
                } else {
                    self::view("layouts/error.php");
                    break;
                }
            case 'users':
                if (Auth::isAdmin()) {
                    UserController::index();
                    break;
                } else {
                    self::view("layouts/error.php");
                    break;
                }
            case 'stocks':
                StockController::index();
                break;
            case 'rawMaterials':
                RawMaterialController::index();
                break;
            case 'merchants':
                MerchantController::index();
                break;
            case 'plasma':
                PlasmaController::index();
                break;
            case 'router':
                RouterController::index();
                break;
            case 'machineType':
                PlasmaController::index();
                break;
            case 'machineConsumable':
                PlasmaController::index();
                break;
            case 'login':
                header('Location: /');
                break;
            case '':
                HomeController::index();
                break;
            case 'invoice':
                PrintController::index();
                break;
            case 'profile':
                ProfileController::index();
                break;
            case 'logout':
                LoginController::logout();
                break;
        }
    }
}
