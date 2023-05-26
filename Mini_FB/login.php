<?php
session_start();

    include("classes/connect.php");
    include("classes/login.php");
    $username="";
    $password="";
    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        $login=new Login();
        $result=$login->evaluate($_POST);
        if($result!="")
        {
            echo "The following errors occurred :<br>";
            echo $result;
        }
        else{
            header("Location:profile.php");
            die;
        }
        $username=$_POST['username'];
        $password=$_POST['password'];
    }

?>


<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login to Facebook</title>
    <style>
        body{
    margin:0;
    padding:0;
    background-color: #dfe3ee;
}
.center{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(20%,-50%);
    width: 400px;
    background-color: white;
    border-radius: 10px;
    padding-bottom:15px;
}
.center h1{
    text-align: center;
    font-family:Tahoma;
    padding-bottom: 10px;
    border-bottom: 1.5px solid blue;
}
.form{
    padding-bottom: 18px;
    padding-right: 10px;
    margin: 0 20px;
    text-align: center;
}
.textfield{
    width: 100%;
    height: 50px;
    font-size: 18px;
    border: 2px solid blue;
    border-radius: 5px;
    box-sizing: border-box;
    padding-left: 10px;
    margin: 8px;
}
.btn{
    width: 100%;
    height: 50px;
    background-color: green;
    border-radius: 8px;
    font-size: 20px;
    margin: 7px 0;
    color: white;
    border: 0;
    cursor: pointer;
    position: relative;
    left: 6px;
    font-weight:bold;
}
.btn:hover{
    background-color:blue;
}
.forgetpass{
    font-size: 16px;
    padding: 4px 0;
    margin: 3px;
}
.link{
    text-decoration: none;
    color: #0a63d8;
}
.msg{
    position:relative;
    top:200px;
    left:150px;
    width:400px;
}
        </style>
</head>
<body>
    <div class="msg">
    <h1 style="color:blue;font-size:100px;font-family:Tahoma;"><strong>facebook</strong></h1>
    <p style="font-family:Verdana, sans-serif;position:relative;bottom:45px;font-size:20px;">Facebook helps you connect and share with the people in your life.</p>
</div>
    <div class="center">
        <h1>Log in</h1>
        <form action="#" method="post" autocomplete="off">
        <div class="form">
            <input value="<?php echo $username ?>" type="text" name="username" class="textfield" placeholder="Username">
            <input value="<?php echo $password ?>" type="password" name="password" class="textfield" placeholder="Password">
            <div class="forgetpass" style="font-family:Tahoma;"><a href="#" class="link" onclick="message()">Forgot Password ?</a></div>
            <input type="submit" name="login" value="Log in" class="btn">
            <div class="signup" style="font-family:Tahoma;position:relative;top:10px;">Don't have an account?&nbsp;&nbsp;<a href="signup.php" class="link">Sign Up</a></div>
</div>
</div>
</form>
</div>
<a href="top_5.php" style="position:relative;left:950px;top:280px;text-decoration:none;color:blue;"><strong style="font-size:20px;font-family:Tahoma;">View top liked posts -></strong></a>
<script>
    function message()
    {
        alert("Try to remember password :)");
    }
    </script>
</body>
</html>