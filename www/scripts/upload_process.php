<?php $configs = include('../config.php'); ?>
<?php
$target_dir = "../pics/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        //add to files
        $conn = mysqli_connect($configs['db'], $configs['db_user'], $configs['db_pass'], $configs['db_name']);
        $query = "INSERT INTO files (path) VALUES (?)";
        $stmt = mysqli_prepare($conn, $query);
        $target_file = substr($target_file, 3);
        mysqli_stmt_bind_param($stmt, "s", $target_file);
        mysqli_stmt_execute($stmt);
        $file_id = mysqli_insert_id($conn);

        //add to posts
        $query = "INSERT INTO posts (title, description,tags,user_id,file_id) VALUES (?,?,?,?,?)";
        $stmt = mysqli_prepare($conn, $query);
        if(isset($_SESSION['id'])) {
            $user_id = $_SESSION['id'];
        }else{
            $user_id = 1;
        }
        $title = $_POST['title'];
        $description = $_POST['description'];
        $tags = $_POST['tags'];
        mysqli_stmt_bind_param($stmt, "sssii", $title, $description,$tags,$user_id,$file_id);
        mysqli_stmt_execute($stmt);
        header('Location: ../index.php');
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>

