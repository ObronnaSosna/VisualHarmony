<!DOCTYPE html>
<html lang="pl">

<?php require_once(__DIR__.'/frame/topBar.php'); ?>
<link href="./css/user_profiles.css" rel="stylesheet">
<link href="./css/styles.css" rel="stylesheet">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        
        <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/gsap.min.js"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<section class="container_user_bar">
    <div class="background_photo" alt="user background photo">
            <div class="user_info_bar">
                <div class="user_avatar" alt="user avatar">
                    
                    <?php
                    if(isset($_SESSION['users_user_ID'])){
                        if($_GET['user']==$_SESSION['users_user_login']){
                            echo '<div class="avatar_fade"><i class="fas fa-user-plus"></i></div>';
                        }else{

                        }
                    }else{
                        
                    }
                    ?>
                    
                    <img src="../pics/avatar_vh.jpg"/>
                </div>
                <div class="user_info_bar_names"> 
                    <h1 class="user_name"><?php echo $user; ?>LensLegend</h1>
                    <p class="green"><?php 
                                        if($row["users_user_type"]==2){
                                            echo 'Admin';
                                        }else{
                                            echo 'Member';
                                        }?></p>
                </div>
                <div class="user_info_bar_stats">
                    <div class="icon_numbers"><i class="far fa-heart" title="Likes"></i><span>121</span></div>
                    <div class="icon_numbers"><i class="far fa-comments" title="Comments"></i><span>53</span></div>
                    <div class="icon_numbers"><i class="far fa-star" title="Favourites"></i><span>0</span></div>
                </div>
        </div>

            
        </div>

    </section>

    <section class="user_photo_container">
        <div class="info">No content yet.</div>
    </section>

    <div class="change_avatar_popup">  
        <div class="change_avatar_popup_content">
            <div class="change_avatar_popup_content_close"><i id="edit_photo_close" class="fas fa-times"></i></div>

            <img src="./img/avatar/<?php echo $row['users_user_avatar']?>.png"/>

            <form action="./php/upload_avatar.php" enctype="multipart/form-data" method="POST" id="usertable">
                <label for="file-upload" class="custom-file-upload">
                <i class="fa fa-cloud-upload"></i><span> Upload Avatar [png]</span>
                </label>
                <input id="file-upload" name="file" type="file"/>
                <input id="btncom5" name="submit" type="submit" value="Save" />
            </form>
        </div>
    </div>
    </body>
    <?php require_once(__DIR__.'/frame/footer.php'); ?>
</html>
