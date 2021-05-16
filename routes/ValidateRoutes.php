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
            'rawMaterials',
            'stocks',
            'plasma',
            'router',
            'machineType',
            'machineConsumable',
            'calendar',
            'machineConsumableInfo',
            'users',
            'routerPrint',
            'plasmaPrint',
            'invoice',
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
                'rawMaterials',
                'stocks',
                'stockInfo',
                'plasma',
                'router',
                'plasma_info',
                'router_info',
                'machineType',
                'calendar',
                'routerPrint',
                'plasmaPrint',
                'machineConsumable',
                'machineConsumableInfo',
                'invoice',
                'users'
            );
        if (in_array($section, $items1)) {
            return true;
        }
        return false;
    }
}
