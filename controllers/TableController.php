<?php

require_once __DIR__ . '/../model/Employee.php';
require_once __DIR__ . '/../model/Customer.php';
require_once __DIR__ . '/../model/Calendar.php';

class TableController extends Controller
{
    public static function count()
    {
        $customers = new Customer();
        $customers = $customers->count();
        $operations = new ItemsSold();
        $operations = $operations->count();
        $consumables = new MachineConsumable();
        $consumables = $consumables->countElectrode();
        $consumabless = new MachineConsumable();
        $consumabless = $consumabless->countNozzle();
        $sold_item = new ItemsSold();
        $sold_items = $sold_item->getGraph();
        $soldd_item = new ItemsSoldd();
        $soldd_items = $soldd_item->getGraph();
        $calendar = new Calendar();
        $calendars = $calendar->get();
        $data['data'] = ['operations' => $operations, 'customers' => $customers,  'consumables' => $consumables, 'consumabless' => $consumabless, 'solditems' => $sold_items, 'soldditems' => $soldd_items, 'calendars' => $calendars];
        header('Content-type: application/json');
        echo json_encode($data);
    }
}
