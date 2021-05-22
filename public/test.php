        <?php
echo "1";
        $servername = "localhost";

        $username = "id16829760_root";
      
        $password = "U*W5GqMIDX]O{vUg";
       
        $dbname = "id16829760_inv_system";
        
        $conn = new mysqli($servername, $username, $password,$dbname);
        if ($conn -> connect_errno) {
            echo "Failed to connect to MySQL: " . $conn -> connect_error;
             exit();
        }
        
        $sql = "SELECT * FROM users WHERE email='adellkanso@gmail.com'  AND password='adjel123';";
        
        $result = $conn->query($sql);
        echo("Errorcode: " . $conn -> errno);
        

        if($result->num_rows > 0){
            echo "222";
        }else{
            echo "     999";
        }