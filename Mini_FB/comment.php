<div id="post">
            
            <div style="position:relative;left:10px;top:5px;height:150px;">
            <div style="font-weight:bold;color:#405d9b;font-size:20px;"><?php echo $COMMENT['username'] ?></div><br><br>
            <span style="font-size:18px;font-family:Tahoma;font-weight:bold;"><?php echo $COMMENT['post'] ?></span>

                <br><br><br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php 
            if(file_exists($COMMENT['image']))
            {
                echo "<img src=".$COMMENT['image'].' width=600px height="500px">';
            }
            ?>
            <br>
            <?php
                $likes="";
                if($COMMENT['likes']>0){
                    $likes="(".$COMMENT['likes'].")";
                }
                else{
                    $likes="";
                }

            ?>
                <a onclick="like_post(event)" href="like.php?type=post&id=<?php echo $COMMENT['postid'] ?>">Like <?php echo $likes ?></a>  &nbsp;&nbsp;.  <span style="color:#999;"><?php echo $COMMENT['date'] ?></span>

                <?php
                if($COMMENT['likes']>0){
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