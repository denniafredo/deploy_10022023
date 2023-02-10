<?php
    $hostmysql  = "192.168.1.5";
    $username   = "root";
    $password   = "p4ss!@#$";
    $database   = "jiwasraya";


    $DB_Smsjiwasraya = mysqli_connect($hostmysql,$username,$password);
    // $conn = @new mysqli($hostmysql, $username, $password, $database);
    // if (!$conn) die ("Koneksi gagal");
    // mysqli_select_db($database,$conn) or die ("Database tidak ditemukan"); 
    // Check connection
    // if (!$DB_Smsjiwasraya) die ("Koneksi gagal");
    // if ($DB_Smsjiwasraya->connect_error) {
    //     die("Connection failed: " . $DB_Smsjiwasraya->connect_error);
    // }else{
    //     echo "Connected successfully";
    //     $sql2 = "SELECT * FROM smsjiwasraya WHERE phone='081252221694'";
    //     //$result = $DB_Smsjiwasraya->query($sql2);
    //     $result =  mysqli_query($DB_Smsjiwasraya, $sql2);
    //     //print_r($result);
    //     print_r($result);
    //     // while($row = $result->fetch_assoc()) {
    //     //     echo "phone: " . $row["phone"]. "<br>";
    //     // }
    // } 

    $conn = new PDO("mysql:host=$hostmysql;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("select * from smsjiwasraya where phone = '081252221694'"); 
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    print_r($result);
    foreach($result as $k=>$v) { 
        echo $v;
    }
    
?>