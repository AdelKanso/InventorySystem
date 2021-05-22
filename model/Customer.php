<?php

require_once 'Model.php';
class Customer extends Model
{
    function count()
    {
        $sql = "SELECT * FROM customers;";
        $result = $this->conn->query($sql);

        return $result->num_rows;
    }

    function get()
    {
        $json = [];
        $sql = "SELECT * FROM customers;";
        $result = $this->conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $json[] = $row;
        }
        return $json;
    }
    function getLatest()
    {
        $json = [];
        $sql = "SELECT * FROM customers,plasma where customers.id=customer_id LIMIT 7;";
        $result = $this->conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $row['id'] = (int) $row['id'];
            $row['name'] = $row['name'];
            $row['address'] =  $row['address'];
            $row['phone'] =  $row['phone'];
            $json[] = $row;
        }
        return $json;
    }
    function show($id)
    {
        $sql = "SELECT * FROM customers WHERE id='$id';";
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


    function insert($data)
    {
        if ($data['email'] == "") {
            $sql = "INSERT INTO customers (name, address, email, phone) VALUES ('" . $data['name'] . "', '" . $data['address'] . "', 'Invalid Email', '" . $data['phone'] . "')";
        } else {
            $sql = "INSERT INTO customers (name, address, email, phone) VALUES ('" . $data['name'] . "', '" . $data['address'] . "', '" . $data['email'] . "', '" . $data['phone'] . "')";
        }
        if ($this->conn->query($sql) === TRUE) {
            $this->conn->close();
            return true;
        } else {
            $this->conn->close();
            return false;
        }
    }

    function update($data)
    {
        $sql = "UPDATE customers SET name='" . $data['name'] . "', address='" . $data['address'] . "', email='" . $data['email'] . "', phone='" . $data['phone'] . "' WHERE id=" . $data["id"];
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
        $sql = "DELETE FROM customers WHERE id='$id'";

        if ($this->conn->query($sql) === TRUE) {
            $this->conn->close();
            return true;
        } else {
            $this->conn->close();
            return false;
        }
    }
}
