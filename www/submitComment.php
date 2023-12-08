<?php

$conn = mysqli_connect('db', 'user', 'test', 'vh');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$defaultUserId = 1;

if (isset($_POST['postId']) && isset($_POST['text'])) {
    $postId = $_POST['postId'];
    $commentText = $_POST['text'];

    $query = "INSERT INTO comments (post_id, text, users_id) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);

    mysqli_stmt_bind_param($stmt, "isi", $postId, $commentText, $defaultUserId);
    mysqli_stmt_execute($stmt);

    if ($stmt) {
        echo json_encode(['status' => 'success', 'message' => 'Comment saved successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error saving comment: ' . mysqli_error($conn)]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'postId or text parameter is missing.']);
}

mysqli_close($conn);
?>
