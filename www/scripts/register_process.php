<?php $configs = include('../config.php'); ?>
<?php
session_start();
if (isset($_POST['newUsername'])) {
$conn = mysqli_connect($configs['db'], $configs['db_user'], $configs['db_pass'], $configs['db_name']);
$query = "INSERT INTO users (user, password) VALUES (?, ?)";
$stmt = mysqli_prepare($conn, $query);
$username = $_POST['newUsername'];
$password = $_POST['newPassword'];
$password = password_hash($password, PASSWORD_DEFAULT);
mysqli_stmt_bind_param($stmt, "ss", $username, $password);
mysqli_stmt_execute($stmt);
header('Location: ../logowanie.php');
exit;
}
