<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pl">

<?php
$configs = include('config.php');
require_once(__DIR__ . '/' . $configs['frame_dir'] . '/head.php');
require_once(__DIR__ . '/' . $configs['frame_dir'] . '/topBar.php');
?>
<body>

    <?php
    $conn = mysqli_connect($configs['db'], $configs['db_user'], $configs['db_pass'], $configs['db_name']);

    // Sprawdzenie połączenia
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $query = 'SELECT * FROM reports';

    if (isset($_GET["tags"])) {
        $tags = htmlspecialchars($_GET["tags"]);
        $tags = mysqli_real_escape_string($conn, $tags);
        $tags = explode(' ', $tags);

        foreach ($tags as $tag) {
            $query .= ' AND reports.tags LIKE "%' . $tag . '%"';
        }
    }

    $result = mysqli_query($conn, $query);
    ?>
    <div class="reportstable">
    <?php
    if ($result) {
    ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Rodzaj zgłoszenia</th>
                    <th>Id posta</th>
                    <th>Link do posta</th>
                    <!-- Dodaj inne kolumny, jeśli istnieją -->
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['title']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['post_id']) . "</td>";
                    echo "<td><a href='http://localhost:8001/pic.php?id=" . htmlspecialchars($row['post_id']) . "' class='view-post-btn'>Pokaż post</a></td>";
                    echo "</tr>";
                }
                ?>

            </tbody>
        </table>
    <?php
    } else {
        echo "Query failed: " . mysqli_error($conn);
    }
    ?>
</div>
</body>

<?php
require_once(__DIR__ . '/frame/footer.php');
?>

</html>
