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
            $row['product_id'] = (int) $row['product_id'];
            $originalDate = $row['dop'];
            $row['dop']  = date("d/m/yy", strtotime($originalDate));
            $json[] = $row;
        }
        return $json;
    }
    function getStock(){
        $json = [];
        $sql = "SELECT  stocks.*,products.`name`,products.`subtype` FROM stocks ,products where stocks.product_id=products.id;";
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
            $row['productName'] = $row['name'];
            $row['productSubtype'] = $row['subtype'];
            $row['dop']  = date("d/m/yy", strtotime($originalDate));
            $json[] = $row;
        }
        return $json;
    }

    function insert($data){
        $sql = "INSERT INTO stocks (`weight`, `price`, `quantity`, `width`, `height`, `thickness`, `merchant_id`, `product_id`,`dop`) VALUES ('".$data['weight']."', '".$data['price']."', '".$data['quantity']."', '".$data['width']."', '".$data['height']."', '".$data['thickness']."', '".$data['merchant_id']."', '".$data['product_id']."', '".$data['dop']."')";

        if ($this->conn->query($sql) === TRUE) {
            $this->conn->close();
            return true;
        } else {
            $this->conn->close();
            return false;
        }
    }

    function show($id){
        $sql = "SELECT stocks.*,products.* FROM stocks,products WHERE stocks.id='$id' and stocks.product_id=products.id;";
        
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
            $row['productName'] = $row['name'];
            $row['productSubtype'] = $row['subtype'];
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
        $sql = "UPDATE stocks SET weight='".$data['weight']."', price='".$data['price']."', quantity='".$data['quantity']."',width='".$data['width']."',height='".$data['height']."',thickness='".$data['thickness']."', product_id='".$data['product_id']."', merchant_id ='".$data['merchant_id']."', dop ='".$data['dop']."' WHERE id=".$data["id"];

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