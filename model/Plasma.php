<?php

require_once 'Model.php';

class Plasma extends Model
{
    function count()
    {
        $dateNow=date("Y-m-d");
        $sql = "SELECT * FROM plasma where dos > '".$dateNow."';";
        $result = $this->conn->query($sql);
        
        $sqll = "SELECT * FROM router where dos > '".$dateNow."';";
        $resultt = $this->conn->query($sqll);

        return ($result->num_rows)+ ($resultt->num_rows);
    }
    function getById($data)
    {   
        $json = [];
        $sql = "SELECT * FROM plasma WHERE id=". $data["id"];
        $result = $this->conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $json[] = $row;
        }
        return $json[0];
    }
    function get()
    {
        $json = [];
        $sql = "SELECT * FROM plasma;";
        $result = $this->conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $json[] = $row;
        }

        return $json;
    }

    function getGraph()
    {
        $dateNow=date("Y-m-d");
        $dateMonthAgo=date('Y-m-d',strtotime('-30 days',strtotime(date("Y-m-d"))));
        $json = [];
        $sql = "SELECT SUM(price) as price ,SUM(cost) as cost ,dos FROM plasma where dos < '".$dateNow."' AND dos> '".$dateMonthAgo."' group by dos order by dos ASC;";
        $result = $this->conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $json[] = $row;
        }
        return $json;
    }

    function insert($data)
    {
        $json = [];
        $sql = "SELECT quantity,price FROM stocks where id=" . $data["stock_id"];
        $result = $this->conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $json[] = $row;
        }
        $jsonn = [];
        $sqlll = "SELECT quantity,price FROM machineconsumable where name='Electrode'";
        $result = $this->conn->query($sqlll);
        while ($row = mysqli_fetch_assoc($result)) {
            $jsonn[] = $row;
        }
        $jsonnn = [];
        $sqllll = "SELECT quantity,price FROM machineconsumable where name='nozzle'";
        $result = $this->conn->query($sqllll);
        while ($row = mysqli_fetch_assoc($result)) {
            $jsonnn[] = $row;
        }
        $jsonnnn = [];
        $sqlllll = "SELECT quantity,price FROM machineconsumable where name='shield'";
        $result = $this->conn->query($sqlllll);
        while ($row = mysqli_fetch_assoc($result)) {
            $jsonnnn[] = $row;
        }
        $check = 0;
        if (
            $json[0]['quantity'] - $data['stockQuantity'] >= 0 &&
            $jsonn[0]['quantity'] - $data['electrode'] >= 0 &&
            $jsonnn[0]['quantity'] - $data['nozzle'] >= 0 &&
            $jsonnnn[0]['quantity'] - $data['shield'] >= 0
        ) {
            $sqll = "INSERT INTO plasma (`name`,`electrode`,`nozzle`,`shield`,`machineType_id`,`stock_id`,`stockQuantity`, `customer_id`, `employee_id`,`fuelprice`,`cost`, `price`, `dos`) VALUES ('" . $data['name'] . "','" . $data['electrode'] . "','" . $data['nozzle'] . "','" . $data['shield'] . "',3,'" . $data['stock_id'] . "','" . $data['stockQuantity'] . "','" . $data['customer_id'] . "', '" . $data['employee_id'] . "', '" . $data['fuelPrice'] . "','".(($json[0]['price']*$data['stockQuantity'])+($jsonnnn[0]['price'] * $data['shield'])+($jsonnn[0]['price'] * $data['nozzle'])+($jsonn[0]['price'] * $data['electrode'])+$data['fuelPrice'] )."', '" . $data['price'] . "', '" . $data['dos'] . "');";
            if ($this->conn->query($sqll) === TRUE) {
                $ssql = "UPDATE stocks SET quantity=quantity-'" . $data['stockQuantity'] . "' WHERE id=" . $data["stock_id"];
                $this->conn->query($ssql);
                $ssqll = "UPDATE machineconsumable SET quantity=quantity-'" . $data['electrode'] . "' WHERE name='Electrode'";
                $this->conn->query($ssqll);
                $ssqlll = "UPDATE machineconsumable SET quantity=quantity-'" . $data['nozzle'] . "' WHERE name='nozzle'";
                $this->conn->query($ssqlll);
                $ssqllll = "UPDATE machineconsumable SET quantity=quantity-'" . $data['shield'] . "' WHERE name='shield'";
                $this->conn->query($ssqllll);
                $check = 1;
            }
            if ($check == 1) {
                $this->conn->close();
                return true;
            } else {
                $this->conn->close();
                return false;
            }
        } else {
            $this->conn->close();
            return false;
        }
    }

    function show($id)
    {
        $sql = "SELECT * FROM plasma WHERE id='$id';";
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
        $json = [];
        $sql = "SELECT electrode,nozzle,shield FROM plasma WHERE id=" . $data["id"];
        $result = $this->conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $json[] = $row;
        }
        $jjjson = [];
        $sql = "SELECT stockQuantity FROM plasma WHERE id=" . $data["id"];
        $result = $this->conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $jjjson[] = $row;
        }
        $jjson = [];
        $sql = "SELECT quantity,price FROM stocks where id=" . $data["stock_id"];
        $result = $this->conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $jjson[] = $row;
        }
        $jsonn = [];
        $sqlll = "SELECT quantity,price FROM machineconsumable where name='electrode'";
        $result = $this->conn->query($sqlll);
        while ($row = mysqli_fetch_assoc($result)) {
            $jsonn[] = $row;
        }
        $jsonnn = [];
        $sqllll = "SELECT quantity,price FROM machineconsumable where name='nozzle'";
        $result = $this->conn->query($sqllll);
        while ($row = mysqli_fetch_assoc($result)) {
            $jsonnn[] = $row;
        }
        $jsonnnn = [];
        $sqlllll = "SELECT quantity,price FROM machineconsumable where name='shield'";
        $result = $this->conn->query($sqlllll);
        while ($row = mysqli_fetch_assoc($result)) {
            $jsonnnn[] = $row;
        }
        if (
            $jjson[0]['quantity'] - $data['stockQuantity'] >= 0 &&
            $jsonn[0]['quantity'] - $data['electrode'] >= 0 &&
            $jsonnn[0]['quantity'] - $data['nozzle'] >= 0 &&
            $jsonnnn[0]['quantity'] - $data['shield'] >= 0
        ) {
            $sql = "UPDATE plasma SET name='" . $data['name'] . "',electrode='" . $data['electrode'] . "',nozzle='" . $data['nozzle'] . "',shield='" . $data['shield'] . "',machineType_id=3,stock_id='" . $data['stock_id'] . "',stockQuantity='" . $data['stockQuantity'] . "', customer_id='" . $data['customer_id'] . "', employee_id='" . $data['employee_id'] . "', fuelprice='" . $data['fuelPrice'] . "',cost='".(($jjson[0]['price']*$data['stockQuantity'])+($jsonnnn[0]['price'] * $data['shield'])+($jsonnn[0]['price'] * $data['nozzle'])+($jsonn[0]['price'] * $data['electrode'])+$data['fuelPrice'] )."', price='" . $data['price'] . "', dos='" . $data['dos'] . "' WHERE id=" . $data["id"];
            if ($data['stockQuantity'] > $jjjson[0]['stockQuantity'])
                $ssql = "UPDATE stocks SET quantity=quantity-'" . ($data['stockQuantity'] - $jjjson[0]['stockQuantity']) . "' WHERE id=" . $data["stock_id"];
            else
                $ssql = "UPDATE stocks SET quantity=quantity+'" . (-$data['stockQuantity'] + $jjjson[0]['stockQuantity']) . "' WHERE id=" . $data["stock_id"];
            if ($data['electrode'] > $json[0]['electrode'])
                $ssqll = "UPDATE machineconsumable SET quantity=quantity-'" . ($data['electrode'] - $json[0]['electrode']) . "' WHERE name='Electrode'";
            else
                $ssqll = "UPDATE machineconsumable SET quantity=quantity+'" . (-$data['electrode'] + $json[0]['electrode']) . "' WHERE name='Electrode'";
            if ($data['nozzle'] > $json[0]['nozzle'])
                $ssqlll = "UPDATE machineconsumable SET quantity=quantity-'" . ($data['nozzle'] - $json[0]['nozzle']) . "' WHERE name='nozzle'";
            else
                $ssqlll = "UPDATE machineconsumable SET quantity=quantity+'" . (-$data['nozzle'] + $json[0]['nozzle']) . "' WHERE name='nozzle'";
            if ($data['shield'] > $json[0]['shield'])
                $ssqllll = "UPDATE machineconsumable SET quantity=quantity-'" . ($data['shield'] - $json[0]['shield']) . "' WHERE name='shield'";
            else
                $ssqllll = "UPDATE machineconsumable SET quantity=quantity+'" . (-$data['shield'] + $json[0]['shield']) . "' WHERE name='shield'";

            if ($this->conn->query($sql) === TRUE) {
                $this->conn->query($ssql);
                $this->conn->query($ssqll);
                $this->conn->query($ssqlll);
                $this->conn->query($ssqllll);
                $this->conn->close();
                return true;
            } else {
                $this->conn->close();
                return false;
            }
        } else {
            $this->conn->close();
            return false;
        }
    }

    function delete($id)
    {
        $sql = "DELETE FROM plasma WHERE id='$id'";

        if ($this->conn->query($sql) === TRUE) {
            $this->conn->close();
            return true;
        } else {
            $this->conn->close();
            return false;
        }
    }
}
