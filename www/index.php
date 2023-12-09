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
    $conn = mysqli_connect($configs['db'], $configs['db_user'], $configs['db_pass'], $configs['db_name']);
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
    document.getElementById('commentText').value = '';
    setTimeout(function() {
        loadComments(postId);
    }, 100);
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

    function submitComment() {
    var text = document.querySelector("#commentText").value;
    var postId = document.getElementById('commentForm').dataset.postid;
    document.getElementById('commentForm').text='';

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

            comments.forEach(function(comment) {
                var commentElement = document.createElement('div');
                commentElement.textContent = comment.commentText;
                commentsContainer.appendChild(commentElement);
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
