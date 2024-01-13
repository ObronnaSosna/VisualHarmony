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

$actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

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
    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $actual_link?>" target="_blank" class=photo-icon-share-facebook title="Share on Facebook">
    <img class="comment" src="img/facebook.png">
    <a href="https://reddit.com/submit?url=<?php echo $actual_link?> onclick="window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" title="Share on Reddit" rel="noopener" class=photo-icon-share-reddit >
    <img class="comment" src="img/reddit.png">
    </a>
    <a href="https://twitter.com/intent/tweet?text=<?php echo $actual_link?>" class=photo-icon-share-twitter title="Tweet">
    <img class="comment" src="img/twitter.png">
    </a>
    <button class="photo-icon-warning" title="Zgłoś post" onclick="warning(<?php echo $row['id'];?>)">
    <img class="warning" src="img/warning.png">
    </button>
    </div>
    <div class="photo-full">
    <img src="<?php echo $row["path"]; ?>" alt="Picture <?php echo $i + 1; ?>" data-postid="<?php echo $row['id']; ?>">
    </div>
    </div>
    <?php } ?>
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

    <div id="warningModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModalw()">&times;</span>
        <div>
            <label class="optionlabel">Zgłoś post</label>
            <div class="options-list">
                <button class="option" onclick="selectOption('opcja1')">Mowa nienawiści lub zakazane symbole</button>
                <button class="option" onclick="selectOption('opcja2')">Przemoc lub niebezpieczne organizacje</button>
                <button class="option" onclick="selectOption('opcja3')">Nękanie lub prześladowanie</button>
                <button class="option" onclick="selectOption('opcja4')">To spam</button>
                <button class="option" onclick="selectOption('opcja5')">Nagość lub aktywność seksualna</button>
                <button class="option" onclick="selectOption('opcja6')">Scam lub oszustwo</button>
                <button class="option" onclick="selectOption('opcja7')">Fałszywe informacje</button>
            </div>
        </div>
        <button type="button" class="submitbutton" onclick="submitReport()">Zgłoś</button>
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

    function warning(postId) {
        document.getElementById('warningModal').style.display = 'flex';
        document.getElementById('options').value = 'opcja1';
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

    function closeModalw() {
        document.getElementById('warningModal').style.display = 'none';
    }

    window.onclick = function(event) {
        if (event.target === document.getElementById('warningModal')) {
            closeModalw();
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
