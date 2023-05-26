<?php
/*if(!isset($_SESSION['facebook_username'])){
    die;
}*/
$query_string=explode("?",$data->link);
$query_string=end($query_string);
$str=explode("&",$query_string);
foreach($str as $value){
    $value=explode("=",$value);
    $_GET[$value[0]]=$value[1];
}
if(isset($_GET['type']) && isset($_GET['id'])){
    if(is_numeric($_GET['id'])){
        $allowed[]='post';
        $allowed[]='profile';
        $allowed[]='comment';
        if(in_array($_GET['type'],$allowed)){
            $post=new Post();
            $post->like_post($_GET['id'],$_GET['type'],$_SESSION['facebook_username']);
        }
    }
    //read likes
    $likes=$post->get_likes($_GET['id'],$_GET['type']);
    $obj=(object)[];
    $obj->likes=count($likes);
    $obj->action="like_post";
    echo json_encode($obj);
}
?>