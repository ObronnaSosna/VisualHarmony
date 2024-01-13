<?php $configs = include('config.php'); ?>
<?php
session_start();
if (isset($_POST['username'])) {
$conn = mysqli_connect($configs['db'], $configs['db_user'], $configs['db_pass'], $configs['db_name']);
$query = "SELECT id, password FROM users WHERE user = ?";
$stmt = mysqli_prepare($conn, $query);
$username = $_POST['username'];
$password = $_POST['password'];
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_bind_result($stmt, $id, $hashed_password);
mysqli_stmt_execute($stmt);
mysqli_stmt_fetch($stmt);
if(password_verify($password, $hashed_password)){
    $_SESSION['loggedin'] = true;
    $_SESSION['id'] = $id;
    $_SESSION['username'] = $username;
    header('Location: index.php');
    exit;
}else{
echo 'Incorrect password';
}
}
