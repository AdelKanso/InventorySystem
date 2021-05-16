<?php

require_once 'Model.php';

class Router extends Model
{
    function count()
    {
        $sql = "SELECT * FROM router;";
        $result = $this->conn->query($sql);

        return $result->num_rows;
    }

    function get()
    {
        $json = [];
        $sql = "SELECT * FROM router;";
        $result = $this->conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $json[] = $row;
        }
        return $json;
    }
    function getById($data)
    {
        $json = [];
        $sql = "SELECT * FROM router WHERE id=" . $data["id"];
        $result = $this->conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $json[] = $row;
        }
        return $json[0];
    }

    function getGraph()
    {
        $dateNow = date("Y-m-d");
        $dateMonthAgo = date('Y-m-d', strtotime('-30 days', strtotime(date("Y-m-d"))));
        $json = [];
        $sql = "SELECT SUM(price) as price ,SUM(cost) as cost ,dos FROM router where dos < '" . $dateNow . "' AND dos> '" . $dateMonthAgo . "' group by dos order by dos ASC;";
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
        $sqlll = "SELECT quantity,price FROM machineconsumable where name='tool'";
        $result = $this->conn->query($sqlll);
        while ($row = mysqli_fetch_assoc($result)) {
            $jsonn[] = $row;
        }
        $jsonnn = [];
        $sqllll = "SELECT quantity,price FROM machineconsumable where name='collet'";
        $result = $this->conn->query($sqllll);
        while ($row = mysqli_fetch_assoc($result)) {
            $jsonnn[] = $row;
        }
        $jsonnnn = [];
        $sqlllll = "SELECT quantity,price FROM machineconsumable where name='toolholder'";
        $result = $this->conn->query($sqlllll);
        while ($row = mysqli_fetch_assoc($result)) {
            $jsonnnn[] = $row;
        }
        $check = 0;
        if (
            $json[0]['quantity'] - $data['stockQuantity'] >= 0 &&
            $jsonn[0]['quantity'] - $data['tool'] >= 0 &&
            $jsonnn[0]['quantity'] - $data['collet'] >= 0 &&
            $jsonnnn[0]['quantity'] - $data['toolholder'] >= 0
        ) {
            $sqll = "INSERT INTO router (`name`,`tool`,`collet`,`toolholder`,`machineType_id`,`stock_id`,`stockQuantity`, `customer_id`, `employee_id`,`fuelprice`,`cost`, `price`, `dos`) VALUES ('" . $data['name'] . "','" . $data['tool'] . "','" . $data['collet'] . "','" . $data['toolholder'] . "',4,'" . $data['stock_id'] . "','" . $data['stockQuantity'] . "','" . $data['customer_id'] . "', '" . $data['employee_id'] . "', '" . $data['fuelPrice'] . "','" . (($json[0]['price'] * $data['stockQuantity']) + ($jsonnnn[0]['price'] * $data['toolholder']) + ($jsonnn[0]['price'] * $data['collet']) + ($jsonn[0]['price'] * $data['tool']) + $data['fuelPrice']) . "', '" . $data['price'] . "', '" . $data['dos'] . "');";
            if ($this->conn->query($sqll) === TRUE) {
                $ssql = "UPDATE stocks SET quantity=quantity-'" . $data['stockQuantity'] . "' WHERE id=" . $data["stock_id"];
                $this->conn->query($ssql);
                $ssqll = "UPDATE machineconsumable SET quantity=quantity-'" . $data['tool'] . "' WHERE name='tool'";
                $this->conn->query($ssqll);
                $ssqlll = "UPDATE machineconsumable SET quantity=quantity-'" . $data['collet'] . "' WHERE name='collet'";
                $this->conn->query($ssqlll);
                $ssqllll = "UPDATE machineconsumable SET quantity=quantity-'" . $data['toolholder'] . "' WHERE name='toolholder'";
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
        $sql = "SELECT * FROM router WHERE id='$id';";
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
        $sql = "SELECT tool,collet,toolholder FROM router WHERE id=" . $data["id"];
        $result = $this->conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $json[] = $row;
        }
        $jjjson = [];
        $sql = "SELECT stockQuantity FROM router WHERE id=" . $data["id"];
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
        $sqlll = "SELECT quantity,price FROM machineconsumable where name='tool'";
        $result = $this->conn->query($sqlll);
        while ($row = mysqli_fetch_assoc($result)) {
            $jsonn[] = $row;
        }
        $jsonnn = [];
        $sqllll = "SELECT quantity,price FROM machineconsumable where name='collet'";
        $result = $this->conn->query($sqllll);
        while ($row = mysqli_fetch_assoc($result)) {
            $jsonnn[] = $row;
        }
        $jsonnnn = [];
        $sqlllll = "SELECT quantity,price FROM machineconsumable where name='toolholder'";
        $result = $this->conn->query($sqlllll);
        while ($row = mysqli_fetch_assoc($result)) {
            $jsonnnn[] = $row;
        }
        if (
            $jjson[0]['quantity'] - $data['stockQuantity'] >= 0 &&
            $jsonn[0]['quantity'] - $data['tool'] >= 0 &&
            $jsonnn[0]['quantity'] - $data['collet'] >= 0 &&
            $jsonnnn[0]['quantity'] - $data['toolholder'] >= 0
        ) {
            $sql = "UPDATE router SET name='" . $data['name'] . "',tool='" . $data['tool'] . "',collet='" . $data['collet'] . "',toolholder='" . $data['toolholder'] . "',machineType_id=4,stock_id='" . $data['stock_id'] . "',stockQuantity='" . $data['stockQuantity'] . "', customer_id='" . $data['customer_id'] . "', employee_id='" . $data['employee_id'] . "',fuelprice='" . $data['fuelPrice'] . "' ,cost='" . (($jjson[0]['price'] * $data['stockQuantity']) + ($jsonnnn[0]['price'] * $data['toolholder']) + ($jsonnn[0]['price'] * $data['collet']) + ($jsonn[0]['price'] * $data['tool']) + $data['fuelPrice']) . "', price='" . $data['price'] . "', dos='" . $data['dos'] . "' WHERE id=" . $data["id"];
            if ($data['stockQuantity'] > $jjjson[0]['stockQuantity'])
                $ssql = "UPDATE stocks SET quantity=quantity-'" . ($data['stockQuantity'] - $jjjson[0]['stockQuantity']) . "' WHERE id=" . $data["stock_id"];
            else
                $ssql = "UPDATE stocks SET quantity=quantity+'" . (-$data['stockQuantity'] + $jjjson[0]['stockQuantity']) . "' WHERE id=" . $data["stock_id"];
            if ($data['tool'] > $json[0]['tool'])
                $ssqll = "UPDATE machineconsumable SET quantity=quantity-'" . ($data['tool'] - $json[0]['tool']) . "' WHERE name='tool'";
            else
                $ssqll = "UPDATE machineconsumable SET quantity=quantity+'" . (-$data['tool'] + $json[0]['tool']) . "' WHERE name='tool'";
            if ($data['collet'] > $json[0]['collet'])
                $ssqlll = "UPDATE machineconsumable SET quantity=quantity-'" . ($data['collet'] - $json[0]['collet']) . "' WHERE name='collet'";
            else
                $ssqlll = "UPDATE machineconsumable SET quantity=quantity+'" . (-$data['collet'] + $json[0]['collet']) . "' WHERE name='collet'";
            if ($data['toolholder'] > $json[0]['toolholder'])
                $ssqllll = "UPDATE machineconsumable SET quantity=quantity-'" . ($data['toolholder'] - $json[0]['toolholder']) . "' WHERE name='toolholder'";
            else
                $ssqllll = "UPDATE machineconsumable SET quantity=quantity+'" . (-$data['toolholder'] + $json[0]['toolholder']) . "' WHERE name='toolholder'";

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
        $sql = "DELETE FROM router WHERE id='$id'";

        if ($this->conn->query($sql) === TRUE) {
            $this->conn->close();
            return true;
        } else {
            $this->conn->close();
            return false;
        }
    }
}
