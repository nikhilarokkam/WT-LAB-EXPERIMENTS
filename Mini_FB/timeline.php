<?php
session_start();
include("classes/connect.php");
include("classes/login.php");
include("classes/user.php");
include("classes/post.php");

$login=new Login();
$user_data=$login->check_login($_SESSION['facebook_username']);

if($_SERVER['REQUEST_METHOD']=="POST")
    {
        $post=new Post();
        $username=$_SESSION['facebook_username'];
        $result=$post->create_post($username,$_POST);
        if($result=="")
        {
            header("Location:profile.php");
            die;
        }else{
            echo "The following errors occurred :<br>";
            echo $result;
        }
    }
    $post=new Post();
    $username=$_SESSION['facebook_username'];
    $posts=$post->get_post($username);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Timeline | Mini Facebook</title>
    <link rel="stylesheet" href="fbstyles.css">
    <style>
    #menu_buttons{
        width:100px;
        display:inline-block;
        margin:2px;
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
        margin-top:10px;
        background-color:white;
        padding:10px;
        padding-right:40px;
        width:1000px;
        position:relative;
        left:60px;
        border-radius:7px;
    }
    #post{
        padding:4px;
        font-size:13px;
        display:flex;
    }
    #friends-bar{
        color:#405d9b;
        padding:8px;
        text-align:center;
    }
    </style>
</head>
<body>
    <!-- Top Bar -->
<nav style="width:1500px;margin:auto;position:relative;left:0.5px;">
    <div class="nav-left" style="display:inline;">
    <img src="All_images\-11595956558bcru1rqewg-modified.png" height="40px" width="45px" style="position:relative;left:40px;top:5px;display:inline;padding: 0.5%;">
    <h1 style="color:white;font-size:35px;font-family:Tahoma;position:relative;left:50px;bottom:10px;display:inline;"><strong>facebook</strong></h1>
    </div>
    <div class="nav-right" style="display:inline;">
    <a href="logout.php"><img src="All_images\logout (1)-modified.png" height="40px" width="45px" style="position:relative;left:1200px;top:5px;display:inline;padding: 0.5%;"></a>
    </div>
</nav>
<div style="width:1500px;margin:auto;height:400px;">
    <!-- Below the Cover Area --->
<div style="display: flex;">
    <!-- Friends Area -->
  <div style="min-height:400px;min-width:250px;height:100px;position:relative;top:60px;border-radius:5px;">
    <div id="friends-bar">
    <?php
        $image="All_images/male_user.png";
        if($user_data['gender']=="Female")
        {
            $image="All_images/female_user.png";
        }
        if(file_exists($user_data['profile_image']))
        {
            $image=$user_data['profile_image'];
        }
    ?>
    <img id="profile-pic" src="<?php echo $image ?>" height="180px" style="position:relative;top:40px;"><br>
    <h2 style="position:relative;top:70px;"><?php echo $user_data['username'] ?></h2>
    </div>
  </div>
    <!-- Posts Area -->
  <div style="min-height:400px;min-width:1250px;position:relative;top:80px;left:5px;border-radius:5px;">
    <div style="padding:10px;height:200px;">
    <textarea placeholder="What's On Your Mind?"></textarea>
    <input id="post_button" type="submit" value="Post">
    <br>
    </div>
    <!-- Posts -->
    <div id="post_bar">

    <?php
    if(isset($posts) && $posts)
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
</div>
</body>
</html>




