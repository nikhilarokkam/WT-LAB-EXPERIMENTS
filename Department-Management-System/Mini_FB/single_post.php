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
$user=$user_data;
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
            header("Location:single_post.php?id=$_GET[id]");
            die;
        }else{
            echo "The following errors occurred :<br>";
            echo $result;
        }
    }

    $post=new Post();
    $ROW=false;
    $ERROR="";
    if(isset($_GET['id'])){
        $ROW=$post->get_one_post($_GET['id']);
    }else{
        $ERROR="No post was found!";
    }
    ?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Comments | Mini Facebook</title>
    <link rel="stylesheet" href="fbstyles.css">
    <style>
        textarea{
        width:600px;
        border:none;
        font-family:Tahoma;
        font-size:14px;
        height:50px;
        padding:20px;
        position:relative;
        left:10px;
        border-radius:7px;
    }
    #post_button{
        position:relative;
        left:500px;
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
<div style="width:800px;margin:auto;min-height:400px;">
<div style="display:flex;">
<div style="min-height:400px;flex:2.5;padding:20px;padding-right:0px;">
<div style="border:solid thin #aaa; padding:10px;baclground-color:white;">
<?php
$user=new User();
$image_class=new Image();
if(is_array($ROW)){
    include("post.php");
    }
?>
<br style="clear:both;">

<div style="padding:10px;height:100px;">
    <form method="post" enctype="multipart/form-data">
        <textarea name="post" placeholder="Post a comment"></textarea>
        <input name="parent" type="hidden" value="<?php echo $ROW['postid'] ?>">
        <input id="post_button" type="submit" value="Post">
        
</form>
    </div>
    <?php
    $comments=$post->get_comments($ROW['postid']);
    if(is_array($comments)){
        foreach($comments as $COMMENT){
            include("comment.php");
        }
    }
    ?>
</div>
</div>
</div>
</div>
</body>
</html>