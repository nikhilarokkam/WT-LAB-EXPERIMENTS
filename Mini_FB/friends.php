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
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Mini Facebook</title>
    <link rel="stylesheet" href="fbstyles.css">
    <style>
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
<nav style="width:1500px;margin:auto;position:relative;left:0.5px;">
    <div class="nav-left" style="display:inline;">
    <img src="All_images\-11595956558bcru1rqewg-modified.png" height="40px" width="45px" style="position:relative;left:40px;top:5px;display:inline;padding: 0.5%;">
    <h1 style="color:white;font-size:35px;font-family:Tahoma;position:relative;left:50px;bottom:10px;display:inline;"><strong>facebook</strong></h1>
    </div>
<div class="nav-right" style="display:inline;">

<a href="logout.php"><img src="All_images\logout (1)-modified.png" height="40px" width="45px" style="position:relative;left:1200px;top:5px;display:inline;padding: 0.5%;"></a>
</div> 
</nav>
<center>
<div style="display: flex;height:400px;width:250px;background-color:white;position:relative;top:90px;left:15px;border-radius:5px;">
  <div id="friends_bar">
  <img src="All_images/friends.png" height="40px" width="45px" style="display:inline;position:relative;">
    
    <hr style="height:2px;align:center;background-color:brown;border-color:brown;width:229px;position:relative;top:15px;">
    <br>
    <br>
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
    </center>
</body>