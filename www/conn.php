<?php
$servername = "localhost";
$username = "user";
$password = "test";

try{

    $conn = new PDO("mysql:host = $servername, dbname = myDb", $usernam, $password);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e){
    echo "Conn fialed: ".$e->getMessage();
}
?>
