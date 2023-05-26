<?php
class Post{
private $error="";
public function create_post($username,$data,$files)
{
    if(!empty($data['post']) || !empty($files['file']['name']))
    {
        $myimage="";
        $has_image=0;
        if(!empty($files['file']['name']))
        {
            $image_class=new Image();
            //create folder
            if(!file_exists($folder))
            {
                mkdir($folder,0777,true);
            }
            $image=new Image();
            //$myimage=$folder.$image->generate_filename(15).".png";
            $myimage=$_FILES['file']['name'];
            move_uploaded_file($_FILES['file']['tmp_name'],$myimage);
            $has_image=1;
        }
        $post="";
        if(isset($data['post'])){
            $post=addslashes($data['post']);
        }
        $postid=$this->create_postid();
        $parent=0;
        $DB=new DataBase();
        if(isset($data['parent']) && is_numeric($data['parent'])){
            $parent=$data['parent'];
            $sql="update posts set comments = comments+1 where postid='$parent' limit 1";
            $DB->save($sql);
        }
        $query="insert into posts (username,postid,post,image,has_image,parent) values ('$username','$postid','$post','$myimage','$has_image','$parent')";
        $DB->save($query);
    }else{
        $this->error .= "Please type something to post!<br>";
    }
    return $this->error;
}
public function get_post($username)
{
    $query="select * from posts where parent=0 and username='$username' order by username desc limit 30";
    $DB=new DataBase();
    $result=$DB->read($query);
    if($result){
        return $result;
    }else{
        return false;
    }
}
public function get_one_post($postid){
    if(!is_numeric($postid)){
        return false;
    }
    $query="select * from posts where postid='$postid' limit 1";
    $DB=new DataBase();
    $result=$DB->read($query);
    if($result){
        return $result[0];
    }
    else{
        return false;
    }
}

public function get_comments($id)
{
    $query="select * from posts where parent='$id' order by id asc limit 30";
    $DB=new DataBase();
    $result=$DB->read($query);
    if($result){
        return $result;
    }else{
        return false;
    }
}

private function create_postid()
{
    $length=rand(4,19);
    $number="";
    for ($i=0;$i<$length;$i++){
        $new_rand=rand(0,9);
        $number=$number.$new_rand;
    }
    return $number;
}
public function get_likes($id,$type){
    $DB=new DataBase();
    $type=addslashes($type);
    if(is_numeric($id)){
        //get like details
        $sql="select likes from likes where type='$type' && contentid='$id' limit 1";
        $result=$DB->read($sql);
        if(is_array($result)){
            $likes=json_decode($result[0]['likes'],true);
            return $likes;
        }
    }
    return false;
}
public function like_post($id,$type,$facebook_username){
    if($type=="post"){
        $DB=new DataBase();
        //increment the posts table
        $sql="update posts set likes =likes+1 where postid='$id' limit 1";
        $DB->save($sql);
        //save likes details
        $sql="select likes from likes where type='post' && contentid='$id' limit 1";
        $result=$DB->read($sql);
        if(is_array($result)){
            $likes=json_decode($result[0]['likes'],true);
            $user_names=array_column($likes,"username");
            if(!in_array($facebook_username,$user_names))
            {
                $arr["username"]=$facebook_username;
                $arr["date"]=date("Y-m-d H:i:s");
                $likes[]=$arr;
                $likes_string=json_encode($likes);
                $sql="update likes set likes='$likes_string' where type='post' && contentid='$id' limit 1";
                $DB->save($sql);
            }
        }else{
            $arr["username"]=$facebook_username;
            $arr["date"]=date("Y-m-d H:i:s");
            $arr2[]=$arr;
            $likes=json_encode($arr2);
            $sql="insert into likes(type,contentid,likes) values ('$type','$id','$likes')";
            $DB->save($sql);
            
        }
    }
}



}
?>