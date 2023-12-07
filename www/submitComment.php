<?php
// submitComment.php

$conn = mysqli_connect('db', 'user', 'test', 'vh');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['postId']) && isset($_POST['commentText'])) {
    $postId = mysqli_real_escape_string($conn, $_POST['postId']);
    $commentText = mysqli_real_escape_string($conn, $_POST['commentText']);

    $query = "INSERT INTO comments (post_id, comment_text) VALUES ($postId, '$commentText')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo json_encode(['message' => 'Comment saved successfully']);
    } else {
        echo json_encode(['error' => 'Error saving comment: ' . mysqli_error($conn)]);
    }
} else {
    echo json_encode(['error' => 'postId or commentText parameter is missing.']);
}

mysqli_close($conn);
?>
