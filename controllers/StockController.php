<?php

require_once 'Controller.php';
require_once __DIR__ . '/../model/Stock.php';
require_once __DIR__ . '/../model/RawMaterial.php';
require_once __DIR__ . '/../model/Merchant.php';
require_once __DIR__ . '/../helpers/ValidateParams.php';


class StockController extends Controller
{
    public static function index()
    {
        $page = 'table';
        self::view('layouts/app.php', $page);
    }

    public static function get()
    {
        $stock = new Stock();
        $stocks = $stock->get();
        foreach ($stocks as $stock) {
            $rawMaterial = new RawMaterial();
            $rawMaterial = $rawMaterial->show($stock['rawMaterial_id']);
            $stock['rawMaterial'] =  $rawMaterial;
            $merchant = new Merchant();
            $merchant = $merchant->show($stock['merchant_id']);
            $stock['merchant'] =  $merchant;
            array_shift($stocks);
            array_push($stocks, $stock);
        }

        $data['data'] = $stocks;
        echo json_encode($data);
    }

    public static function show($id)
    {
        $stock = new Stock();
        $stock = $stock->show($id);
        if ($stock == false) {
            $d = ['stock' => ['No stock found with this id.']];
            header('Content-type: application/json');
            http_response_code(422);
            echo json_encode($d);
        } else {
            $data['data'] = ['weight' => $stock['weight'], 'price' => $stock['price'], 'quantity' => $stock['quantity'], 'width' => $stock['width'], 'height' => $stock['height'], 'thickness' => $stock['thickness'], 'merchant_id' => $stock['merchant_id'], 'rawMaterial_id' => $stock['rawMaterial_id'], 'dop' => $stock['dop']];

            header('Content-type: application/json');
            echo json_encode($data);
        }
    }

    public static function insert($data)
    {
        $stock = new Stock();
        $result = true;
        $d = [];
        if (!ValidateParams::validateInteger($data['rawMaterial_id'])) {
            $result = false;
            $d['rawMaterial_id'] = ['The rawMaterial  id must be a integer value'];
        }
        if (!ValidateParams::validateInteger($data['merchant_id'])) {
            $result = false;
            $d['merchant_id'] = ['The merchant  id must be a integer value'];
        }
        if (!ValidateParams::date($data['dop'])) {
            $result = false;
            $d['doj'] = ['The date must be in valid format(YYYY-MM-DD).'];
        }
        if (!ValidateParams::isEmpty($data['width'])) {
            $result = false;
            $d['width'] = ['The width must contain a value'];
        }
        if (!ValidateParams::isEmpty($data['height'])) {
            $result = false;
            $d['height'] = ['The height must contain a value'];
        }
        if (!ValidateParams::isEmpty($data['thickness'])) {
            $result = false;
            $d['thickness'] = ['The thickness must contain a value'];
        }
        if (!ValidateParams::isEmpty($data['price'])) {
            $result = false;
            $d['price'] = ['The price must contain a value'];
        }
        if (!ValidateParams::isEmpty($data['weight'])) {
            $result = false;
            $d['weight'] = ['The weight must contain a value'];
        }
        if ($result == true) {
            $stock = $stock->insert($data);
            if ($stock == false) {
                $d = ['stock' => ['There was an error inserting stock.']];
                header('Content-type: application/json');
                http_response_code(422);
                echo json_encode($d);
            } else {
                $d = ['stock' => ['Stock has been successfully added.']];
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
        $stock = new Stock();
        $result = true;
        $d = [];
        if (!ValidateParams::validateInteger($data['merchant_id'])) {
            $result = false;
            $d['merchant_id'] = ['The merchant id id must be a integer value'];
        }

        if ($result == true) {
            $stock = $stock->update($data);
            if ($stock == false) {
                $d = ['stock' => ['There was an error updating content.']];
                header('Content-type: application/json');
                http_response_code(422);
                echo json_encode($d);
            } else {
                $d = ['stock' => ['Stock has been successfully updated.']];
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
        $stock = new Stock();
        if ($stock->delete($id)) {
            $d = ['stock' => ['Stock has been successfully deleted.']];
            header('Content-type: application/json');
            echo json_encode($d);
        } else {
            $d = ['stock' => ['There was an error deleting stock.']];
            header('Content-type: application/json');
            http_response_code(422);
            echo json_encode($d);
        }
    }

    public static function info()
    {
        $rawMaterial = new RawMaterial();
        $rawMaterials = $rawMaterial->get();
        $merchant = new Merchant();
        $merchants = $merchant->get();
        $data['data']['rawMaterials'] = $rawMaterials;
        $data['data']['merchants'] = $merchants;
        echo json_encode($data);
    }
}
