<div id="post">
            
            <div style="position:relative;left:10px;top:5px;">
            <div style="font-weight:bold;color:#405d9b;font-size:20px;"><?php echo $ROW['username'] ?></div><br><br>
            <span style="font-size:18px;font-family:Tahoma;font-weight:bold;"><?php echo $ROW['post'] ?></span>

                <br><br><br><br><br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php 
            if(file_exists($ROW['image']))
            {
                echo "<img src=".$ROW['image'].' width=300px height="500px">';
            }
            ?>
            <br><br>
            <?php
                $likes="";
                if($ROW['likes']>0){
                    $likes="(".$ROW['likes'].")";
                }
                else{
                    $likes="";
                }

            ?>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a onclick="like_post(event)" href="like.php?type=post&id=<?php echo $ROW['postid'] ?>">Like <?php echo $likes ?></a> . 
                <?php
                $comments="";
                if($ROW['comments']>0){
                    $comments="(".$ROW['comments'].")";
                }else{
                    $comments="";
                }
                ?>
                <a href="single_post.php?id=<?php echo $ROW['postid'] ?>">Comment <?php echo $comments ?></a>  . <span style="color:#999;"><?php echo $ROW['date'] ?></span>

                <?php
                if($ROW['likes']>0){
                        echo "<span style='float:left;'>" . $ROW['likes']." people liked this post</span>";
                    }
                ?>
            </div>
        </div>
        <br>
<script type="text/javascript">
    function ajax_send(data,element){
        var ajax = new XMLHttpRequest();
        ajax.addEventListener('readystatechange',function(){
            if(ajax.readyState==4 && ajax.status==200){
                response(ajax.responseText,element);
            }
        });
        data=JSON.stringify(data);

        ajax.open("post","ajax.php",true);
        ajax.send(data);
    }
    function response(result,element){
        if(result!=""){
            var obj=JSON.parse(result);
            if(typeof obj.action!='undefined'){
                if(obj.action=='like_post'){
                    var likes="";
                    likes=(parseInt(obj.likes)>0)?"Like("+obj.likes+")":"Like";
                    element.innerHTML=likes;
                }
            }
        }
    }
    function like_post(e){
        e.preventDefault();
        var link=e.target.href;
        var data={};
        data.link=link;
        data.action="like_post";
        ajax_send(data,e.target);
    }
</script>
</html>



<!--<div>
                <?php
                $image="All_images/male_user.png";
                if($ROW_USER['gender']=="Female"){
                    $image="All_images/female_user.png";
                }
                if(file_exists($user_data['profile_image']))
                {
                    $image=$user_data['profile_image'];
                }
                ?>
            <img src="<?php echo $image ?>" height="30px" width="35px" style="margin-right:5px;">
            </div>-->