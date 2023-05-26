<?php
session_start();
include("classes/connect.php");
include("classes/login.php");
include("classes/user.php");
include("classes/post.php");
include("classes/image.php");
$login=new Login();
$user_data=$login->check_login($_SESSION['facebook_username']);

//posting starts here
if($_SERVER['REQUEST_METHOD']=="POST")
{
    if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != "")
    {
        if($_FILES['file']['type']=="image/png")
        {
        //$folder="uploads/".$user_data['username']."/";
            $folder="uploads/";
        //create folder
        if(!file_exists($folder))
        {
            mkdir($folder,0777,true);
        }
        $image=new Image();

        //$filename=$folder . $image->generate_filename(15). ".png";
        $filename=$folder.basename($_FILES['file']['name']);
        move_uploaded_file($_FILES['file']['tmp_name'],$filename);
        if(file_exists($filename)){
            $username=$user_data['username'];
            $query="update users set profile_image='$filename' where username='$username' limit 1";

            $DB=new DataBase();
            $DB->save($query);
            header("Location:profile.php");
            die;
        } 

    }else{
        echo "The following errors occurred!<br>";
        echo "Please add a valid image!<br>";
    }
        }
        else{
            echo "<br>The following errors occurred!<br>";
            echo "Only images of png type are allowed.<br>";
        }
}
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
        left:400px;
        top:5px;
        margin: 1.8em;
        height: 30px;
        font-size: 18px;
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
<div style="display: flex;margin-top:40px;">
    <!-- Posts Area -->
  <div style="min-height:400px;flex:2.5;padding:20px;padding-right:0px;">
  <form method="post" enctype="multipart/form-data">
    <div style="border:solid thin #aaa;padding:10px;height:100px;width:800px;position:relative;left:300px;">
    <input type="file" name="file">
    <input id="post_button" type="submit" value="Change">
    <br>
    </div>
  </form>
</div>
</div>
</body>
</html>