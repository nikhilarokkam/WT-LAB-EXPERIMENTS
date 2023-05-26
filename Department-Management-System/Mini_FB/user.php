<div id="friends">
<?php
                $image="All_images/male_user.png";
                if($FRIEND_ROW['gender']=="Female"){
                    $image="All_images/female_user.png";
                }
                if(file_exists($FRIEND_ROW['profile_image']))
                {
                    $image=$FRIEND_ROW['profile_image'];
                }
        ?>
        <a href="profile.php?username=<?php echo $FRIEND_ROW['username']; ?>" style="text-decoration:none;">
        <img id="friends_img" src="<?php echo $image ?>">
        <strong style="position:relative;top:36px;left:10px;"><?php echo $FRIEND_ROW['username']?></strong>
        </a>
</div>