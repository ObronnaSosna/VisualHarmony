<?php
$configs = include('../config.php');

$conn = mysqli_connect($configs['db'], $configs['db_user'], $configs['db_pass'], $configs['db_name']);

if (!$conn) {
    echo json_encode(['status' => 'error', 'message' => 'Database connection failed', 'errorDetails' => mysqli_connect_error()]);
    exit;
}

$defaultUserId = 1;

if (isset($_POST['postId']) && isset($_POST['reportTitle'])) {
    $postId = (int)$_POST['postId']; // Zamiana na liczbę całkowitą
    $reportTitle = $_POST['reportTitle'];

    $query = "INSERT INTO reports (title, post_id) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $query);

    if (!$stmt) {
        echo json_encode(['status' => 'error', 'message' => 'Error preparing statement', 'errorDetails' => mysqli_error($conn)]);
        exit;
    }

    mysqli_stmt_bind_param($stmt, "si", $reportTitle, $postId); // Zamiana miejscami parametrów

    $result = mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    if ($result) {
        echo json_encode(['status' => 'success', 'message' => 'Report saved successfully']);
    } else {
        $errorDetails = mysqli_error($conn);
        error_log("Error saving report: $errorDetails");
        echo json_encode(['status' => 'error', 'message' => 'Error saving report', 'errorDetails' => $errorDetails]);
    }

    mysqli_close($conn);
} else {
    echo json_encode(['status' => 'error', 'message' => 'postId or reportTitle parameter is missing.']);
}
?>
