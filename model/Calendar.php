<?php

require_once 'Model.php';
class Calendar extends Model
{
    function count()
    {
        $sql = "SELECT * FROM calendar;";
        $result = $this->conn->query($sql);

        return $result->num_rows;
    }

    function get()
    {
        session_start();
        $json = [];
        $sql = "SELECT * FROM calendar where user_id=".$_SESSION['userId'].";";
        $result = $this->conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $json[] = $row;
        }
        return $json;
    }

    function show($dayy, $monthh)
    {
        $sql = "SELECT * FROM calendar WHERE dayy='$dayy',monthh='$monthh';";
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
        $sql = "INSERT INTO calendar (dayy, monthh,eventDescription) VALUES ('" . $data['dayy'] . "', '" . $data['monthh'] . "','" . $data['description'] . "')";
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
        $sql = "UPDATE calendar SET dayy='" . $data['dayy'] . "', monthh='" . $data['monthh'] . "',eventDescription='" . $data['description'] . "' WHERE id=" . $data["id"];
        if ($this->conn->query($sql) === TRUE) {
            $this->conn->close();
            return true;
        } else {
            $this->conn->close();
            return false;
        }
    }

    function delete($dayy, $m, $desc)
    {
        $sql = "DELETE FROM calendar WHERE dayy='$dayy' and monthh='$m' and eventDescription='$desc' ";
        if ($this->conn->query($sql) === TRUE) {
            $this->conn->close();
            return true;
        } else {
            $this->conn->close();
            return false;
        }
    }
}
