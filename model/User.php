<?php

require_once 'Model.php';

class User extends Model
{
    function valid($email, $pass)
    {
        $sql = "SELECT * FROM users WHERE email='$email'  AND password='$pass';";
        $result = $this->conn->query($sql)or die(mysql_error());

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            session_start();
            $_SESSION['id'] = $row['employee_id'];
            $_SESSION['userId'] = $row['id'];
            $_SESSION['role'] = $row['role'];
            $this->conn->close();
            return true;
        } else {
            $this->conn->close();
        }
    }

    function get()
    {
        $json = [];
        $sql = "SELECT * FROM users;";
        $result = $this->conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $json[] = $row;
        }

        return $json;
    }

    function insert($data)
    {
        $sql = "INSERT INTO users (`employee_id`, `email`, `password`, `role`) VALUES ('" . $data['emp_id'] . "', '" . $data['email'] . "', 'secret', '" . $data['role'] . "')";

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
        $sql = "SELECT * FROM users WHERE id='$id';";
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

    function showByEmployee($emp_id)
    {
        $sql = "SELECT * FROM users WHERE employee_id='$emp_id';";
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
        $sql = "UPDATE users SET email='" . $data['email'] . "', role='" . $data['role'] . "' WHERE id=" . $data["id"];

        if ($this->conn->query($sql) === TRUE) {
            $this->conn->close();
            return true;
        } else {
            $this->conn->close();
            return false;
        }
    }

    function updateByEmployee($data)
    {
        $sql = "UPDATE users SET email='" . $data['email'] . "', password='" . $data['password'] . "' WHERE employee_id=" . $data["employee_id"];

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
        $sql = "DELETE FROM users WHERE id='$id'";

        if ($this->conn->query($sql) === TRUE) {
            $this->conn->close();
            return true;
        } else {
            $this->conn->close();
            return false;
        }
    }
}
