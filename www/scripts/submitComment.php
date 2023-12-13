<?php
$configs = include('../config.php');

$conn = mysqli_connect($configs['db'], $configs['db_user'], $configs['db_pass'], $configs['db_name']);

if (!$conn) {
    echo json_encode(['status' => 'error', 'message' => 'Database connection failed', 'errorDetails' => mysqli_connect_error()]);
    exit;
}

$defaultUserId = 1;

if (isset($_POST['postId']) && isset($_POST['text'])) {
    $postId = (int)$_POST['postId']; // Zamiana na liczbę całkowitą
    $commentText = $_POST['text'];

    $query = "INSERT INTO comments (post_id, text, users_id) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);

    if (!$stmt) {
        echo json_encode(['status' => 'error', 'message' => 'Error preparing statement', 'errorDetails' => mysqli_error($conn)]);
        exit;
    }

    mysqli_stmt_bind_param($stmt, "isi", $postId, $commentText, $defaultUserId);

    $result = mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    if ($result) {
        echo json_encode(['status' => 'success', 'message' => 'Comment saved successfully']);
    } else {
        $errorDetails = mysqli_error($conn);
        error_log("Error saving comment: $errorDetails"); // Dodaj logowanie błędu do pliku logów serwera
        echo json_encode(['status' => 'error', 'message' => 'Error saving comment', 'errorDetails' => $errorDetails]);
    }

    mysqli_close($conn);
} else {
    echo json_encode(['status' => 'error', 'message' => 'postId or text parameter is missing.']);
}
?>
