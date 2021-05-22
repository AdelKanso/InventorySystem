<?php

require_once 'Model.php';

class MachineConsumable extends Model
{
    function get()
    {
        $json = [];
        $sql = "SELECT * FROM machineconsumable;";
        $result = $this->conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $json[] = $row;
        }
        return $json;
    }
    function countElectrode()
    {
        $sql = "SELECT quantity FROM machineconsumable where name='Electrode';";
        $result = $this->conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        $quantity =  $row['quantity'];
        return $quantity;
    }
    function countNozzle()
    {
        $sql = "SELECT quantity FROM machineconsumable where name='Nozzle';";
        $result = $this->conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        $quantity =  $row['quantity'];
        return $quantity;
    }
    function insert($data)
    {
        $sql = "INSERT INTO machineconsumable (`machineType_id`,`name`,`serialNumber`,`quantity`,`description`,`price`) VALUES ( '" . $data['machineType_id'] . "','" . $data['name'] . "', '" . $data['serialNumber'] . "', '" . $data['quantity'] . "', '" . $data['description'] . "', '" . $data['price'] . "')";

        if ($this->conn->query($sql) === TRUE) {
            $this->conn->close();
            return true;
        } else {
            $this->conn->close();
            return false;
        }
    }

    function show($id)
    {
        $sql = "SELECT * FROM machineconsumable WHERE id='$id';";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $this->conn->close();
            return $row;
        } else {
            $this->conn->close();
            return false;
        }
    }

    function update($data)
    {
        $sql = "UPDATE machineconsumable SET machineType_id ='" . $data['machineType_id'] . "',name='" . $data['name'] . "', serialNumber='" . $data['serialNumber'] . "', quantity='" . $data['quantity'] . "', description='" . $data['description'] . "', price='" . $data['price'] . "' WHERE id=" . $data["id"];

        if ($this->conn->query($sql) === TRUE) {
            $this->conn->close();
            return true;
        } else {
            $this->conn->close();
            return false;
        }
    }

    function delete($id)
    {
        $sql = "DELETE FROM machineconsumable WHERE id='$id'";

        if ($this->conn->query($sql) === TRUE) {
            $this->conn->close();
            return true;
        } else {
            $this->conn->close();
            return false;
        }
    }
 
    function nearOutOfStock()
    {
        $json = [];
        $sql = "SELECT * FROM machineconsumable where quantity<10 ;";
        $result = $this->conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $row['id'] = (int) $row['id'];
            $row['name'] =  $row['name'];
            $row['quantity'] = (int) $row['quantity'];
            $json[] = $row;
        }
        return $json;
    }

    public static function info()
    {
        $machineType = new MachineType();
        $machineTypes = $machineType->get();
        $data['data']['machineTypes'] = $machineTypes;
        echo json_encode($data);
    }
}
