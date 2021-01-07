<?php

class ValidateRoutes
{

    public static function webValidate($uri)
    {
        $items1 = array(
            'login',
            'profile',
            'customers',
            'employees',
            'merchants',
            'products',
            'stocks',
            'items_sold',
            'items_soldd',
            'machineType',
            'machineConsumable',
            'calendar',
            'machineConsumableInfo',
            'users',
            'print',
            'printt',
            'logout'
        );

        if ($uri[1] == '') {
            return true;
        }
        if (in_array($uri[1], $items1)) {
            return true;
        }
        return false;
    }

    public static function apiValidate($section)
    {
        $items1 =
            array(
                'login',
                'tables',
                'customers',
                'employees',
                'merchants',
                'products',
                'stocks',
                'stockInfo',
                'items_sold',
                'items_soldd',
                'items_sold_info',
                'items_soldd_info',
                'machineType',
                'calendar',
                'machineConsumable',
                'machineConsumableInfo',
                'print',
                'printt',
                'users'
            );
        if (in_array($section, $items1)) {
            return true;
        }
        return false;
    }
}
