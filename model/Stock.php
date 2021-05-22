<?php


require_once 'Model.php';

class Stock extends Model
{
    function count(){
        $sql = "SELECT * FROM stocks;";
        $result = $this->conn->query($sql);

        return $result->num_rows;
    }
    function get(){
        $json = [];
        $sql = "SELECT * FROM stocks;";
        $result = $this->conn->query($sql);
        while($row = mysqli_fetch_assoc($result)){
            $row['id'] = (int) $row['id'];
            $row['weight'] = $row['weight'];
            $row['price'] = $row['price'];
            $row['quantity'] = (int)$row['quantity'];
            $row['width'] = $row['width'];
            $row['height'] = $row['height'];
            $row['thickness'] = $row['thickness'];
            $row['merchant_id'] = (int) $row['merchant_id'];
            $row['rawMaterial_id'] = (int) $row['rawMaterial_id'];
            $originalDate = $row['dop'];
            $row['dop']  = date("d/m/yy", strtotime($originalDate));
            $json[] = $row;
        }
        return $json;
    }
    function getStock(){
        $json = [];
        $sql = "SELECT  stocks.*,rawmaterials.`name`,rawmaterials.`subtype` FROM stocks ,rawmaterials where stocks.rawMaterial_id=rawmaterials.id;";
        $result = $this->conn->query($sql);
        while($row = mysqli_fetch_assoc($result)){
            $row['id'] = (int) $row['id'];
            $row['weight'] = $row['weight'];
            $row['price'] = $row['price'];
            $row['quantity'] = (int)$row['quantity'];
            $row['width'] = $row['width'];
            $row['height'] = $row['height'];
            $row['thickness'] = $row['thickness'];
            $row['merchant_id'] = (int) $row['merchant_id'];
            $originalDate = $row['dop'];
            $row['rawMaterialName'] = $row['name'];
            $row['rawMaterialSubtype'] = $row['subtype'];
            $row['dop']  = date("d/m/yy", strtotime($originalDate));
            $json[] = $row;
        }
        return $json;
    }

    function insert($data){
        $sql = "INSERT INTO stocks (`weight`, `price`, `quantity`, `width`, `height`, `thickness`, `merchant_id`, `rawMaterial_id`,`dop`) VALUES ('".$data['weight']."', '".$data['price']."', '".$data['quantity']."', '".$data['width']."', '".$data['height']."', '".$data['thickness']."', '".$data['merchant_id']."', '".$data['rawMaterial_id']."', '".$data['dop']."')";

        if ($this->conn->query($sql) === TRUE) {
            $this->conn->close();
            return true;
        } else {
            $this->conn->close();
            return false;
        }
    }

    function show($id){
        $sql = "SELECT stocks.*,rawmaterials.* FROM stocks,rawmaterials WHERE stocks.id='$id' and stocks.rawMaterial_id=rawmaterials.id;";
        
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $row['id'] = (int) $row['id'];
            $row['weight'] =  $row['weight'];
            $row['price'] =  $row['price'];
            $row['quantity'] = (int)$row['quantity'];
            $row['width'] = $row['width'];
            $row['height'] = $row['height'];
            $row['thickness'] = $row['thickness'];
            $row['merchant_id'] = (int) $row['merchant_id'];
            $row['rawMaterialName'] = $row['name'];
            $row['rawMaterialSubtype'] = $row['subtype'];
            $originalDate = $row['dop'];
            $row['dop']  = date("d/m/yy", strtotime($originalDate));
            $this->conn->close();
            return $row;
        } else {
            $this->conn->close();
            return false;
        }
    }

    function update($data){
        $sql = "UPDATE stocks SET weight='".$data['weight']."', price='".$data['price']."', quantity='".$data['quantity']."',width='".$data['width']."',height='".$data['height']."',thickness='".$data['thickness']."', rawMaterial_id='".$data['rawMaterial_id']."', merchant_id ='".$data['merchant_id']."', dop ='".$data['dop']."' WHERE id=".$data["id"];

        if ($this->conn->query($sql) === TRUE) {
            $this->conn->close();
            return true;
        } else {
            $this->conn->close();
            return false;
        }
    }

    function delete($id){
        $sql = "DELETE FROM stocks WHERE id='$id'";

        if ($this->conn->query($sql) === TRUE) {
            $this->conn->close();
            return true;
        } else {
            $this->conn->close();
            return false;
        }
    }

}