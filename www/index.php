<?php session_start();?>
<!DOCTYPE html>
<html lang="pl">
<?php $configs = include('config.php'); ?>
<?php require_once(__DIR__.'/'.$configs['frame_dir'].'/head.php'); ?>
<?php require_once(__DIR__.'/'.$configs['frame_dir'].'/topBar.php'); ?>
<body>

    <section>
        <img class="logo" src="img/visual_logo.png">
    </section>

    <section>
    <form action="index.php" method="GET">
        <div class="search">
            <div>
                <button id='search' class="magnifier">
                    <img src="img/lupa.png">
                </button>
            </div>
            <div>
                <input name='tags' class="searchbar" type="text" placeholder="Szukaj po tagach">
            </div>
        </div>
        </form>
    </section>


    <section>
        <div class="row">
<?php
$conn = mysqli_connect($configs['db'], $configs['db_user'], $configs['db_pass'], $configs['db_name']);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if(isset($_GET["tags"])){
    $tags = htmlspecialchars($_GET["tags"]);
    $tags = mysqli_escape_string($conn,$tags);
    $tags = explode(' ',$tags);
}
$query = 'SELECT posts.id, files.path FROM posts,files WHERE posts.file_id=files.id ';
if(isset($_GET["tags"])){
    foreach($tags as $tag){
        $query .= 'AND posts.tags LIKE "%'.$tag.'%" ';
    }
}
$query .= 'ORDER BY posts.upvote / (posts.downvote+1) DESC;';
    //echo $query;

$result = mysqli_query($conn, $query);


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
    <button class="photo-icon-heart" onclick="like(<?php echo $row['id'];?>)">
    <img class="like" src="img/heart.png">
    </button>
    <button class="photo-icon-heart-dislike" onclick="dislike(<?php echo $row['id'];?>)">
    <img class="dislike" src="img/heart-unlike.png">
    </button>
    <button class="photo-icon-comment">
    <img class="comment" src="img/comment.png" onclick="openModal(<?php echo $row['id']; ?>)">
    </button>
    </div>
    <a href="<?php echo 'pic.php?id='.$row['id']?>">
    <div class="photo" >
    <img  src="<?php echo $row["path"]; ?>" alt="Picture <?php echo $i + 1; ?>" data-postid="<?php echo $row['id']; ?>">
    </div>
    </a>
    </div>
    <?php $i=$i+1;} ?>
    </div>
    </section>

    <div id="myModal" class="modal">
    <div class="modal-content">
    <span class="close" onclick="closeModal()">&times;</span>
    <div id="commentsContainer"></div>
    <form id="commentForm" data-postid="">
    <textarea id="commentText" placeholder="Dodaj swój komentarz"></textarea>
    <button type="button" class="submitbutton" onclick="submitComment()">Wyślij</button>
    </form>
    </div>
    </div>
    </div>

    <script>
    function openModal(postId) {
        document.getElementById('myModal').style.display = 'flex';
        document.getElementById('commentText').value = '';
        setTimeout(function() {
            loadComments(postId);
        }, 100);
        document.getElementById('commentForm').dataset.postid = postId;
    }
    function like(postId){
        var formData = new FormData();
        formData.append('postId', postId);
        fetch('scripts/like.php', { method: 'POST', body: formData})
    };

    function dislike(postId){
        var formData = new FormData();
        formData.append('postId', postId);
        fetch('scripts/dislike.php', { method: 'POST', body: formData})
    };
    function closeModal() {
        document.getElementById('myModal').style.display = 'none';
    }

    window.onclick = function(event) {
        if (event.target === document.getElementById('myModal')) {
            closeModal();
        }
    }

    function submitComment() {
    var text = document.querySelector("#commentText").value.trim();
    var postId = document.getElementById('commentForm').dataset.postid;

    
    if (text === '') {
        alert('Komentarz nie może być pusty. Wprowadź treść komentarza.');
        return;
    }

    if (text.length > 255) {
        alert('Komentarz nie może przekraczać 255 znaków.');
        return;
    }

    document.querySelector("#commentText").value = '';

    fetch('scripts/submitComment.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
            postId: postId,
            text: text,
        }),
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                console.log('Comment saved successfully:', data.message);
                loadComments(postId);
            } else {
                console.error('Error saving comment:', data.message);
            }
        })
        .catch(error => {
            console.error('Error saving comment:', error);
        });
}


    function loadComments(postId) {
    $.ajax({
        url: 'scripts/loadComments.php',
        type: 'GET',
        data: { postId: postId },
        success: function (comments) {
            var commentsContainer = document.getElementById('commentsContainer');
            commentsContainer.innerHTML = '';

            comments.forEach(function (comment) {
                var commentWrapper = document.createElement('div');
                commentWrapper.classList.add('comment-wrapper');

                var userBox = document.createElement('div');
                userBox.classList.add('user-box');
                userBox.textContent = 'Test user';
                commentWrapper.appendChild(userBox);

                var commentBox = document.createElement('div');
                commentBox.classList.add('comment-box');
                commentBox.textContent = comment.commentText;
                commentWrapper.appendChild(commentBox);

                commentsContainer.appendChild(commentWrapper);
            });
        },
        error: function (error) {
            console.error('Error fetching comments:', error);
        }
    });
}
$(document).keypress(function(e){
    if (e.which == 13){
        $("#search").click();
    }
});

    </script>
</body>
<?php require_once(__DIR__.'/'.$configs['frame_dir'].'/footer.php'); ?>
</html>
