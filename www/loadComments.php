<?php
// loadComments.php

$conn = mysqli_connect('db', 'user', 'test', 'vh');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['postId'])) {
    $postId = mysqli_real_escape_string($conn, $_GET['postId']);

    $query = "SELECT * FROM comments WHERE post_id = $postId";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $comments = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $comments[] = $row;
        }
        
        header('Content-Type: application/json');
        echo json_encode($comments);
    } else {
        echo json_encode(['error' => 'Error fetching comments: ' . mysqli_error($conn)]);
    }
} else {
    echo json_encode(['error' => 'postId parameter is missing.']);
}

mysqli_close($conn);
?>
