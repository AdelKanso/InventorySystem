<?php


require_once 'Controller.php';
require_once __DIR__ . '/../model/Calendar.php';

class CalendarController extends Controller
{

    public static function insert($data)
    {
        $calendar = new Calendar();
        $calendar = $calendar->insert($data);
        if ($calendar == false) {
            $d = ['calendar' => ['Event already exist.']];
            header('Content-type: application/json');
            http_response_code(422);
            echo json_encode($d);
        } else {
            $d = ['calendar' => ['Event has been successfully added.']];
            header('Content-type: application/json');
            echo json_encode($d);
        }
    }



    public static function delete($day,$month,$desc)
    {
        
        $calendar = new Calendar();
        if ($calendar->delete($day,$month,$desc)) {
            $d = ['calendar' => ['Event has been successfully deleted.']];
            header('Content-type: application/json');
            echo json_encode($d);
        } else {
            $d = ['calendar' => ['There was an error deleting event.']];
            header('Content-type: application/json');
            http_response_code(422);
            echo json_encode($d);
        }
    }
}
