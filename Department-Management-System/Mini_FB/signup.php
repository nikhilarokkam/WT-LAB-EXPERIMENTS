<?php
    include("classes/connect.php");
    include("classes/signup.php");
    $username="";
    $gender="";
    $email="";
    $contact="";
    $dob="";
    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        $signup=new Signup();
        $result=$signup->evaluate($_POST);
        if($result!=""){
            echo "The following errors occurred :<br>";
            echo $result;
        }
        else{
            header("Location:login.php");
            die;
        }
        $username=$_POST['username'];
    $gender=$_POST['gender'];
    $email=$_POST['email'];
    $contact=$_POST['contact'];
    $dob=$_POST['dob'];
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Sign Up for Facebook | Facebook</title>
        <style>
            body{
    background-color: #95BDFF;
    font-family: Tahoma;
    font-weight: bolder;
    }
    .center{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
    width: 750px;
    background-color: white;
    border-radius: 20px;
    
}
    input,textarea{
        background-color: #F5F5F5;
        border:#0a0a23;
    }
    .submit{
        display: inline;
        width: 8%;
        margin: 1.8em auto;
        height: 50px;
        font-size: 20px;
        font-weight: bold;
        background-color: green;
        border-color: green;
        min-width: 100px;
        border-radius: 8px;
        cursor: pointer;
        color: white;
    }
    input[type="reset"] {
        display: inline;
        width: 5%;
        margin: 1.5em auto;
        height: 50px;
        font-size: 20px;
        font-weight: bold;
        background-color: green;
        border-color: green;
        min-width: 100px;
        border-radius: 8px;
        cursor: pointer;
        color: white;
    }
    .textfield{
    width: 150%;
    height: 45px;
    font-size: 18px;
    border: 2px solid blue;
    border-radius: 5px;
    box-sizing: border-box;
    padding-left: 10px;
    margin: 0px;
}
.table{
    position: relative;
    right: 50px;
}
        </style>
    </head>
    <body>
        <div class="center">
        <center>
            <strong><h1>Create a new account</h1></strong>
            <p>It's quick and easy.</p>
            <hr style="height:2px;background-color: blue;border-color: blue;" >
            <form action="" method="post" enctype="multipart/form-data" autocomplete="off">
                <table  cellspacing="30" class="table">
                    <tr>
                        <td><label for="username">User Name</label></td>
                        <td><input value="<?php echo $username ?>" type="text" name="username" class="textfield" placeholder="Username"></td>
                    </tr>
                    <tr>
                        <td><label for="email">Email</label></td>
                        <td><input value="<?php echo $email ?>" type="email" name="email" class="textfield" placeholder="Email address"></td>
                    </tr>
                    <tr>
                        <td><label for="contact">Contact</label></td>
                        <td><input value="<?php echo $contact ?>" type="text" name="contact" pattern="[0-9]{10}" class="textfield" placeholder="Phone number"></td>
                    </tr>
                    <tr>
                        <td><label for="password">Password</label></td>
                        <td><input type="password" name="password" pattern="[a-zA-Z0-5]{8,}" class="textfield" placeholder="New Password"></td>
                    </tr>
                    <tr>
                        <td><label for="dob">Date Of Birth</label></td>
                        <td><input value="<?php echo $dob ?>" type="date" name="dob" class="textfield"></td>
                    </tr>
                    <tr>
                        <td><label for="gender">Gender</label></td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="gender" value="Male">&nbsp;<label>Male</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="gender" value="Female">&nbsp;<label>Female</label>&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="gender" value="Others">&nbsp;<label>Others</label></center></td>
                    </tr>
                </table>
                        <input type="submit" class="submit" value="Signup">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="reset" value="Reset">
            </form>
            
        </center>
    </div>
</body>
</html>

