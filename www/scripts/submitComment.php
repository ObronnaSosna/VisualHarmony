<?php $configs = include('../config.php'); ?>
<?php

$conn = mysqli_connect($configs['db'], $configs['db_user'], $configs['db_pass'], $configs['db_name']);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$defaultUserId = 1;

if (isset($_POST['postId']) && isset($_POST['text'])) {
    $postId = (int)$_POST['postId']; // Zamiana na liczbę całkowitą
    $commentText = $_POST['text'];

    $query = "INSERT INTO comments (post_id, text, users_id) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);

    mysqli_stmt_bind_param($stmt, "isi", $postId, $commentText, $defaultUserId);

    $result = mysqli_stmt_execute($stmt);


    if ($result) {
        echo json_encode(['status' => 'success', 'message' => 'Comment saved successfully']);
    } else {
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            // Jeśli to jest asynchroniczne żądanie AJAX, zwróć odpowiedź JSON
            echo json_encode(['status' => 'error', 'message' => 'Error saving comment', 'errorDetails' => mysqli_error($conn)]);
        } else {
            // W przeciwnym razie zwróć pełną stronę HTML z błędem
            die('Error saving comment: ' . mysqli_error($conn));
        }
    }
    

    mysqli_close($conn);
} else {
    echo json_encode(['status' => 'error', 'message' => 'postId or text parameter is missing.']);
}

?>
