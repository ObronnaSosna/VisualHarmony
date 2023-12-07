<?php

$conn = mysqli_connect('db', 'user', 'test', 'vh');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Domyślne user_id
$defaultUserId = 1;

if (isset($_POST['postId']) && isset($_POST['text'])) {
    $postId = $_POST['postId'];
    $commentText = $_POST['text'];

    // Zabezpieczenie przed SQL Injection - prepared statement
    $query = "INSERT INTO comments (post_id, text, users_id) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);

    mysqli_stmt_bind_param($stmt, "isi", $postId, $commentText, $defaultUserId);
    mysqli_stmt_execute($stmt);

    if ($stmt) {
        // Kodowanie komunikatu JSON
        echo json_encode(['message' => 'Comment saved successfully']);
    } else {
        // Kodowanie błędu JSON
        echo json_encode(['error' => 'Error saving comment: ' . mysqli_error($conn)]);
    }
} else {
    // Kodowanie błędu JSON
    echo json_encode(['error' => 'postId or text parameter is missing.']);
}

mysqli_close($conn);
?>
