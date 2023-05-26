<?php  
// Database configuration  
$dbHost     = "localhost";  
$dbUsername = "root";  
$dbPassword = "";  
$dbName     = "mini_facebook";  
  
// Create database connection  
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);  
  
// Check connection  
if ($db->connect_error) {  
    die("Connection failed: " . $db->connect_error);  
}
?>
<?php 
 
// Get image data from database 
$result = $db->query("SELECT image from posts order by likes desc limit 5"); 
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Top 5 Posts | Mini Facebook</title>
    <link rel="stylesheet" href="fbstyles.css">
</head>
<body>
<nav style="width:1500px;margin:auto;">
<div class="nav-left" style="display:inline;">
    <img src="All_images\-11595956558bcru1rqewg-modified.png" height="40px" width="45px" style="position:relative;left:40px;top:5px;display:inline;padding: 0.5%;">
    <h1 style="color:white;font-size:35px;font-family:Tahoma;position:relative;left:50px;bottom:10px;display:inline;"><strong>facebook</strong></h1>
    </div>

</nav>
<br><br><br>
<center><div style="width:350px;height:50px;background-image: linear-gradient( 35.2deg,  rgba(0,119,182,1) -18.7%, rgba(8,24,68,1) 54.3% );border-radius:50px;"><strong style="font-size:30px;position:relative;top:7px;color:#F8F4EA;font-family:Tahoma;">Top 5 Liked Posts</strong></div></center>
<br><br><br><br><br>
<center>
<?php if($result->num_rows > 0){ ?> 
    <div class="gallery"> 
        <?php while($row = $result->fetch_assoc()){ ?> 
            <?php if(file_exists($row['image']))
            {
                echo "<img src=".$row['image'].' width=300px height="400px">';
            }?>
        <?php } ?> 
    </div> 
<?php }else{ ?> 
    <p class="status error">Image(s) not found...</p> 
<?php } ?>
</center>
<br>
</body>
</html>