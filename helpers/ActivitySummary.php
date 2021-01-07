<?php

class ActivitySummary
{

    public function __construct()
    {
        $_SESSION['consumable'] = array();
    }

    static function consumable($data)
    {
        $row = array();
        $row['weight'] = $data['weight'];
        $row['purity'] = $data['purity'];
        $row['rate'] = $data['rate_id'];
        $_SESSION['consumable'][] = $row;
    }
}

