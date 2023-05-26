<?php
    session_start();
    //print_r($_SESSION);
    include("classes/connect.php");
    include("classes/login.php");
    include("classes/user.php");
    include("classes/post.php");
    include("classes/image.php");
    include("classes/profile.php");
    $login=new Login();
    $user_data=$login->check_login($_SESSION['facebook_username']);
    if(isset($_GET['username'])){
        $profile=new Profile();
        $profile_data=$profile->get_profile($_GET['username']);
        if(is_array($profile_data))
        {
            $user_data=$profile_data[0];
        }
    }
    //posting starts here
    if($_SERVER['REQUEST_METHOD']=="POST")
    {
        $post=new Post();
        $username=$_SESSION['facebook_username'];
        $result=$post->create_post($username,$_POST,$_FILES);
        if($result=="")
        {
            header("Location:profile.php");
            die;
        }else{
            echo "The following errors occurred :<br>";
            echo $result;
        }
    }
    //collect posts
    $post=new Post();
    $username=$user_data['username'];
    $posts=$post->get_post($username);
    //collect friends
    $user=new User();
    $username=$user_data['username'];
    $friends=$user->get_friends($username);
    //
    $image_class=new Image();
//print_r($user_data);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Mini Facebook</title>
    <link rel="stylesheet" href="fbstyles.css">
    <style>
    #menu_buttons{
        width:100px;
        display:inline-block;
        margin:2px;
    }
    #friends_img{
        width:75px;
        float:left;
        margin:8px;
    }
    #friends_bar{
        
        min-height:400px;
        margin-top:20px;
        padding:8px;
    }
    #friends{
        clear:both;
    }
    textarea{
        width:1100px;
        border:none;
        font-family:Tahoma;
        font-size:14px;
        height:150px;
        padding:20px;
        position:relative;
        left:50px;
        border-radius:7px;
    }
    #post_button{
        position:relative;
        left:1045px;
        bottom:80px;
        margin: 1.8em;
        height: 30px;
        font-size: 20px;
        font-weight: bold;
        background-color: green;
        border-color: green;
        min-width: 100px;
        border-radius: 5px;
        cursor: pointer;
        color: white;
    }
    #post_bar{
        margin-top:80px;
        background-color:white;
        padding:10px;
        padding-right:40px;
        width:1000px;
        position:relative;
        left:60px;
        border-radius:7px;
    }
    #like_button{
        position: relative;
        left: 700px;
        top: 120px;
        margin: 1.8em;
        height: 30px;
        font-size: 20px;
        font-weight: bold;
        background-color: green;
        border-color: green;
        min-width: 100px;
        border-radius: 5px;
        cursor: pointer;
        color: white;
    }
    #post{
        padding:4px;
        font-size:13px;
        display:flex;
    }
    #link{
        text-decoration:none;
    }
    #link:visited{
        color:blue;
    }

    </style>
</head>
<body>
    <!-- Top Bar -->
<nav style="width:1500px;margin:auto;">
    <div class="nav-left" style="display:inline;">
    <img src="All_images\-11595956558bcru1rqewg-modified.png" height="40px" width="45px" style="position:relative;left:40px;top:5px;display:inline;padding: 0.5%;">
    <h1 style="color:white;font-size:35px;font-family:Tahoma;position:relative;left:50px;bottom:10px;display:inline;"><strong>facebook</strong></h1>
    </div>
<div class="nav-right" style="display:inline;">
<a href="logout.php"><img src="All_images\logout (1)-modified.png" height="40px" width="45px" style="position:relative;left:1200px;top:5px;display:inline;padding: 0.5%;"></a>
</div> 
</nav>
    <!-- Cover Area -->
    <div style="width:1500px;margin:auto;height:400px;">
    <div style="background-color:#F9F5EB;text-align:center;color:blue;font-weight:bold;font-size:large;padding-bottom:6.5px;">
    <img src="All_images/Welcome.png" height="300px" width="1500px">
    
            <?php
                $image="All_images/male_user.png";
                if($user_data['gender']=="Female"){
                    $image="All_images/female_user.png";
                }
                if(file_exists($user_data['profile_image']))
                {
                    $image=$user_data['profile_image'];
                }
            ?>
    
    <img src="<?php echo $image ?>" height="150px" style="margin-top:-500px;"><br>
    <a style="text-decoration:none;color:#f0f;font-size:13px;" href="change_profile_image.php">Change Image</a>
    </span>
    <br>
    <div style="font-size:20px;position:relative;top:8px;font-family:Tahoma;font-weight:bold;"><?php echo $user_data['username'] ?></div>
    <br><br>
    <div id="menu_buttons"><a id="link" href="timeline.php"><img src="All_images\timeline.png" height="40px" width="45px"></a></div>
    <div id="menu_buttons"><a id="link" href="friends.php"><img src="All_images\friends.png" height="40px" width="45px"></a></div>
    <div id="menu_buttons"><a id="link" href="photos.php"><img src="All_images\picture.png" height="40px" width="45px"></a></div>
    </div>
    <!-- Below the Cover Area --->
<div style="display: flex;">
    <!-- Friends Area -->
  <div style="display: flex;height:400px;min-width:250px;background-color:white;position:relative;top:15px;left:15px;border-radius:5px;">
  <div id="friends_bar">
  <img src="All_images/friends.png" height="40px" width="45px" style="display:inline;position:relative;left:20px;">
    <strong style="display:inline;position:relative;bottom:35px;"><center>Friends</center></strong>
    <hr style="height:2px;align:center;background-color:brown;border-color:brown;width:229px;position:relative;bottom:10px;">
    <?php
        if($friends)
        {
            foreach ($friends as $FRIEND_ROW){
                include("user.php");
            }
        }   
        ?>

</div>
</div>
    <!-- Posts Area -->
  <div style="min-height:400px;min-width:1250px;position:relative;top:15px;left:5px;border-radius:5px;">
    <div style="padding:10px;height:200px;">
    <form method="post" enctype="multipart/form-data">
        <textarea name="post" placeholder="What's On Your Mind?"></textarea>
        <input id="post_button" type="submit" value="Post">
        <input type="file" name="file" style="position:relative;left:300px;">
</form>
    </div>
    <!-- Posts -->
    <div id="post_bar"> 
    
    <?php 
    $DB=new DataBase();
    $user_class=new User();
    $friends=$user_class->get_friends($_SESSION['facebook_username']);
    $friends_names=false;
    if(is_array($friends)){
        $friends_names=array_column($friends,"username");
        $friends_names=implode("','",$friends_names);
    }
    if($friends_names){
        $sql="select * from posts where username in('".$friends_names. "') limit 30";
        $posts=$DB->read($sql);
    }
    if($posts)
    {
        foreach ($posts as $ROW){
            $user=new User();
            $ROW_USER=$user->get_user($ROW['username']);

            include("post.php");
        }
        
    }   
        ?>
</div>
</div>
</body>



<!--//check if user is logged in
    if(isset($_SESSION['facebook_username'])){
        $username=$_SESSION['facebook_username'];
        $login=new Login();
        $result=$login->check_login($username);
        if($result){
            //retrieve user data
            $user=new User();
            $user_data=$user->get_data($username);
            if(!$user_data)
            {
                header("Location:login.php");
                die;
            }
        }else{
            header("Location:login.php");
            die;
        }
    }
    else{
        header("Location:login.php");
        die;
    }-->
</html>