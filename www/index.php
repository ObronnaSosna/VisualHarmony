<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moja Strona</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300&family=Ubuntu&display=swap" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body>
    <header>
        <h2 class="title">
            VISUAL HARMONY
        </h2>
        <div class="navbar">
            <a href="#" title="Jesteś już na stronie głównej!" class="a-menu">STRONA GŁÓWNA</a>
            <a href="onas.php" title="Poznaj nas" class="a-menu">O NAS</a>
            <a href="kontakt.php" title="Skontaktuj się z nami" class="a-menu">KONTAKT</a>
            <a href="logowanie.php" title="Przejdź do strony logowania" class="a-menu">LOGOWANIE</a>
        </div>
    </header>

    <section>
        <img class="logo" src="img/visual_logo.png">
    </section>

    <section>
        <div class="search">
            <div>
                <button class="magnifier">
                    <img src="img/lupa.png">
                </button>
            </div>
            <div>
                <input class="searchbar" type="text" placeholder="Szukaj po tagach">
            </div>
        </div>
    </section>


    <section>
        <div class="row">
    <?php
    $conn = mysqli_connect('db', 'user', 'test', "vh");
    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
    $result = mysqli_query($conn, 'select posts.id, files.path from posts,files where posts.file_id=files.id order by posts.upvote desc;');

    // Kolumny w jednym wierszu
    $columnsInRow = 3;

    //Pętla gewnerujaca kolumny
    //for ($i = 0; $i < mysqli_num_rows($result); $i ++) {
    $i = 0;
    while($row = mysqli_fetch_assoc($result)) {
        if($i % $columnsInRow === 0){
            echo '</div><div class="row">';
        }
    ?>
            <div class="column">
            <div class="photobuttons">
                <button class="photo-icon-heart">
                    <img class="like" src="img/heart.png">
                </button>
                <button class="photo-icon-heart-dislike">
                    <img class="dislike" src="img/heart-unlike.png">
                </button>
                <button class="photo-icon-comment">
                        <img class="comment" src="img/comment.png" onclick="openModal(<?php echo $row['id']; ?>)">
                </button>
            </div>
            <div class="photo">
                <img src="<?php echo $row["path"]; ?>" alt="Picture <?php echo $i + 1; ?>" data-postid="<?php echo $row['id']; ?>">
            </div>
        </div>
    <?php $i=$i+1;} ?>
</div>
    </section>


    <footer>
        <div class="box">
            <div class="foot1">&copy; Copyright © 2023 Visual Harmony. 
                Created by: Natalia Jezusek, Nikola Niestrój,
                Jacek Kozak, Daniel Łątkowski.</div>
            <div class="foot2">
                <br>
                <h2>VISUAL HARMONY</h2>
                <br>
            </div>
            <div class="foot3">
                <div class="bottom-icon">
                <button class="regulations"><a href="regulamin.php" title="Zobacz nasz regulamin!" class="footer-link">
                    <img src="img/regulations.png">
                </button></a>
                <h3><a href="regulamin.php" title="Zobacz nasz regulamin!" class="footer-link">Regulamin</a></h3>
                </div>

                <div class="bottom-icon">
                <button class="facebook"><a href="https://www.facebook.com/profile.php?id=61553216010644" class="footer-link">
                    <img src="img/facebook.png">
                </button></a>
                <h3><a href="https://www.facebook.com/profile.php?id=61553216010644" class="footer-link">Facebook</a></h3>
                </div>

                <div class="bottom-icon">
                <button class="instagram"><a href="https://www.instagram.com/harmony.visual/" class="footer-link">
                    <img src="img/instagram.png">
                </button></a>
                <h3><a href="https://www.instagram.com/harmony.visual/" class="footer-link">Instagram</a></h3>
                </div>
        </div>
    </footer>

    <div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <div id="commentsContainer"></div>
        <form id="commentForm" data-postid="">
            <textarea id="commentText" placeholder="Dodaj swój komentarz"></textarea>
            <button type="button" onclick="submitComment()">Wyślij</button>
        </form>
    </div>
    </div>
</div>

<script>
    function openModal(postId) {
        document.getElementById('myModal').style.display = 'flex';
        loadComments(postId);
        document.getElementById('commentForm').dataset.postid = postId;
    }

    function closeModal() {
        document.getElementById('myModal').style.display = 'none';
    }

    window.onclick = function(event) {
        if (event.target === document.getElementById('myModal')) {
            closeModal();
        }
    }

    function loadComments(postId) {
        $.ajax({
            url: 'loadComments.php',
            type: 'GET',
            data: { postId: postId },
            success: function (response) {
                document.getElementById('commentsContainer').innerHTML = response;
            },
            error: function (error) {
                console.error('Error fetching comments:', error);
            }
        });
    }

    function submitComment() {
    var text = document.querySelector("#commentText").value;
    var postId = document.getElementById('commentForm').dataset.postid;
    $.ajax({
        url: 'submitComment.php',
        type: 'POST',
        data: { postId: postId, text: text },
        success: function (response) {
            console.log('Comment saved successfully:', response.message);
            loadComments(postId);
        },
        error: function (error) {
            console.error('Error saving comment:', error);
        }
    });
}


</script>

</body>

</html>
