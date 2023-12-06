<?php
$servername = "localhost";
$username = "user";
$password = "test";
$database = "myDb";

$conn = new mysqli($servername, $username, $password, $database);


if ($conn->connect_error) {
    die("Nie udało się połączyć z bazą danych: " . $conn->connect_error);
}

echo "Połączenie z bazą danych udane";



$conn->close();
?>
