<?php

require_once 'Model.php';

class RawMaterial extends Model
{
    function get()
    {
        $json = [];
        $sql = "SELECT * FROM rawMaterials;";
        $result = $this->conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $json[] = $row;
        }

        return $json;
    }

    function insert($data)
    {
        $sql = "INSERT INTO rawMaterials (`name`,`subtype`) VALUES ('" . $data['name'] . "', '".$data['subtype']."')";

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
        $sql = "SELECT * FROM rawMaterials WHERE id='$id';";
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
        $sql = "UPDATE rawMaterials SET name='" . $data['name'] . "', subtype='".$data['subtype']."' WHERE id=" . $data["id"];

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
        $sql = "DELETE FROM rawMaterials WHERE id='$id'";

        if ($this->conn->query($sql) === TRUE) {
            $this->conn->close();
            return true;
        } else {
            $this->conn->close();
            return false;
        }
    }
}