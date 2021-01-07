<?php

class Model
{
    public $conn;
    public function __construct()
    {
        $servername = "localhost:3306";
        $username = "root";
        $password = "123";
        $dbname = "inv_system";
        $this->conn = new mysqli($servername, $username, $password, $dbname);
    }
}