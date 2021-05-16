<?php

require_once __DIR__ . '/../model/Employee.php';
require_once __DIR__ . '/../model/Customer.php';
require_once __DIR__ . '/../model/Calendar.php';

class TableController extends Controller
{
    public static function dashboard()
    {
        $customers = new Customer();
        $customers = $customers->count();
        $operations = new Plasma();
        $operations = $operations->count();
        $consumables = new MachineConsumable();
        $consumables = $consumables->countElectrode();
        $consumabless = new MachineConsumable();
        $consumabless = $consumabless->countNozzle();
        $plasma = new Plasma();
        $plasmas = $plasma->getGraph();
        $router = new Router();
        $routers = $router->getGraph();
        $calendar = new Calendar();
        $calendars = $calendar->get();
        $data['data'] = ['operations' => $operations, 'customers' => $customers,  'consumables' => $consumables, 'consumabless' => $consumabless, 'plasmas' => $plasmas, 'routers' => $routers, 'calendars' => $calendars];
        header('Content-type: application/json');
        echo json_encode($data);
    }
}
