<!DOCTYPE html>
<html lang="pl">
<?php $configs = include('config.php'); ?>
<?php require_once(__DIR__.'/'.$configs['frame_dir'].'/head.php'); ?>
<?php require_once(__DIR__.'/'.$configs['frame_dir'].'/topBar.php'); ?>
<body>




    <section>
        <div class="row">
<?php
$postId = htmlspecialchars($_GET["id"]);
$conn = mysqli_connect($configs['db'], $configs['db_user'], $configs['db_pass'], $configs['db_name']);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$query = 'SELECT posts.id, files.path FROM posts,files WHERE posts.file_id=files.id AND posts.id=?';
$stmt = mysqli_prepare($conn, $query);

mysqli_stmt_bind_param($stmt, "i", $postId);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
while($row = mysqli_fetch_assoc($result)) {
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
    <div class="photo-full">
    <img src="<?php echo $row["path"]; ?>" alt="Picture <?php echo $i + 1; ?>" data-postid="<?php echo $row['id']; ?>">
    </div>
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


    </script>
</body>
<?php require_once(__DIR__.'/'.$configs['frame_dir'].'/footer.php'); ?>
</html>
