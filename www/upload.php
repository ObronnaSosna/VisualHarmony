<?php session_start();?>
<!DOCTYPE html>
<html lang="pl">
<?php require_once(__DIR__.'/frame/head.php'); ?>
<?php require_once(__DIR__.'/frame/topBar.php'); ?>

<head>
<link rel="stylesheet" type="text/css" href="./css/login.css">
</head>

<body>
    <div class="container">
        <h2>Dodaj post</h2>
        <form id="loginForm" class="form-container" action="scripts/upload_process.php" method="post" enctype="multipart/form-data">
            <label >Tytul:</label>
            <input type="text" name="title" required>

            <label >Opis:</label>
            <input type="text" name="description" required>

            <label >Tagi:</label>
            <input type="text" name="tags" required>

            <label >Wybierz plik:</label>
            <input type="file" name="fileToUpload" id="fileToUpload">

            <button type="submit">Zapostuj</button>
        </form>

</body>
<?php require_once(__DIR__.'/frame/footer.php'); ?>
</html>
