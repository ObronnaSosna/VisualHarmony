<?php $configs = include('../config.php'); ?>
<?php

$conn = mysqli_connect($configs['db'], $configs['db_user'], $configs['db_pass'], $configs['db_name']);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['postId'])) {
    $postId = $_GET['postId'];

    // Zabezpieczenie przed SQL Injection - prepared statement
    $query = "SELECT * FROM comments WHERE post_id = ?";
    $stmt = mysqli_prepare($conn, $query);

    mysqli_stmt_bind_param($stmt, "i", $postId);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if ($result) {
        $comments = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $row['commentText'] = $row['text'];
            unset($row['text']);
            $comments[] = $row;
        }

        // Kodowanie danych JSON
        header('Content-Type: application/json');
        echo json_encode($comments);
    } else {
        // Kodowanie błędu JSON
        echo json_encode(['error' => 'Error fetching comments: ' . mysqli_error($conn)]);
    }
} else {
    // Kodowanie błędu JSON
    echo json_encode(['error' => 'postId parameter is missing.']);
}

mysqli_close($conn);
?>
