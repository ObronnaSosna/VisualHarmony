<?php $configs = include('../config.php'); ?>
<?php

$conn = mysqli_connect($configs['db'], $configs['db_user'], $configs['db_pass'], $configs['db_name']);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
#if (isset($_POST['postId']){ // z jakiegos powodu kompletnie to nie dziala xd
    $postId = (int)$_POST['postId']; // Zamiana na liczbę całkowitą
    $query = "UPDATE posts SET upvote = upvote+1 WHERE id=?";
    $stmt = mysqli_prepare($conn, $query);

    mysqli_stmt_bind_param($stmt,"i",$postId);

    $result = mysqli_stmt_execute($stmt);
    mysqli_close($conn);
#}
?>
