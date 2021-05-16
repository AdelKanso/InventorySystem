<?php

require_once 'Controller.php';

class PrintController extends Controller
{
    public static function index()
    {
        $page = 'print';
        self::view('layouts/app.php', $page);
    }
    public static function get()
    {
        $operation = new Router();
        $operations = $operation->get();
        $operationn = new Plasma();
        $operationn = $operationn->get();
        $data['data'] = $operations;
        $data['dataa']= $operationn;
        echo json_encode($data);
    }
    public static function getRouterOpById($data)
    {
        $operation = new Router();
        $operation = $operation->getById($data);
        $stock = new Stock();
        $stock = $stock->show($operation['stock_id']);
        $customer = new Customer();
        $customer = $customer->show($operation['customer_id']);
        $consumable = new MachineConsumable();
        $consumable = $consumable->get();
        $machine = new MachineType();
        $machine = $machine->show(4);
        $data['data']['stock']=$stock;
        $data['data']['customer']=$customer;
        $data['data'] ['operation']= $operation;
        $data['data'] ['consumable']= $consumable;
        $data['data'] ['machine']= $machine;

        
        echo json_encode($data);
        
    }
    public static function getPlasmaOpById($data)
    {
        $operation = new Plasma();
        $operation = $operation->getById($data);
        $stock = new Stock();
        $stock = $stock->show($operation['stock_id']);
        $customer = new Customer();
        $customer = $customer->show($operation['customer_id']);
        $consumable = new MachineConsumable();
        $consumable = $consumable->get();
        $machine = new MachineType();
        $machine = $machine->show(3);
        $data['data']['stock']=$stock;
        $data['data']['customer']=$customer;
        $data['data'] ['operation']= $operation;
        $data['data'] ['consumable']= $consumable;
        $data['data'] ['machine']= $machine;
        
        echo json_encode($data);
        
    }
}
