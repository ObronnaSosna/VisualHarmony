<?php session_start();?>
<!DOCTYPE html>
<html lang="pl">
<?php $configs = include('config.php'); ?>
<?php require_once(__DIR__.'/frame/topBar.php'); ?>
<link href="./css/user_profiles.css" rel="stylesheet">
<link href="./css/styles.css" rel="stylesheet">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
    integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300&family=Ubuntu&display=swap" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/gsap.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<section class="container_user_bar">
    <div class="background_photo" alt="user background photo">
        <div class="user_info_bar">
            <div class="user_avatar" alt="user avatar">
                

                <?php
                if (!isset($_SESSION['username'])) {
                    // Jeśli użytkownik nie jest zalogowany, użyj JavaScript do przekierowania
                    echo '<script>window.location.href = "index.php";</script>';
                    exit();
                }
                    ?>

                    <?php
                $conn = mysqli_connect($configs['db'], $configs['db_user'], $configs['db_pass'], $configs['db_name']);
                $userId = mysqli_real_escape_string($conn, $_SESSION['id']);
                $query = "SELECT avatar FROM profiles WHERE profiles.user_id = $userId ";
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_assoc($result)

                ?>
                <img src="<?php echo $row['avatar'] ?>" />
            </div>
            <div class="user_info_bar_names">
                <h1 class="user_name"><?php echo $_SESSION['username']; ?></h1>

            </div>
            <div class="user_info_bar_stats">
                <div class="icon_numbers"><i class="far fa-heart" title="Likes"></i><span>121</span></div>
                <div class="icon_numbers"><i class="far fa-comments" title="Comments"></i><span>53</span></div>
                <div class="icon_numbers"><i class="far fa-star" title="Favourites"></i><span>0</span></div>
            </div>
        </div>
    </div>
</section>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<section class="content-photos">

        <?php
    
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }


    
    $query = "SELECT posts.id, files.path FROM posts, files, users WHERE users.id = $userId AND posts.file_id = files.id AND posts.user_id = users.id;";

    // $query = 'SELECT posts.id, files.path FROM posts, files WHERE user_id = $_SESSION['id'] AND posts.file_id=files.id;';

    $result = mysqli_query($conn, $query);

    // Kolumny w jednym wierszu
    $columnsInRow = 3;

    // Pętla generująca kolumny
    $i = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        if ($i % $columnsInRow === 0) {
            echo '</div><div class="row">';
        }
        ?>
        <div class="column">

            <a href="<?php echo 'pic.php?id=' . $row['id'] ?>">
                <div class="photo">
                    <img src="<?php echo $row["path"]; ?>" alt="Picture <?php echo $i + 1; ?>"
                        data-postid="<?php echo $row['id']; ?>">
                </div>
            </a>
        </div>
        <?php $i = $i + 1;
    }

    // Dodaj sekcję "No content yet" jeśli nie ma zdjęć
    if ($i === 0) {
        echo '<section class="user_photo_container">
                <div class="info">No content yet.</div>
              </section>';
    }
    ?>

</section>
<?php require_once(__DIR__.'/frame/footer.php'); ?>
</body>


</html>