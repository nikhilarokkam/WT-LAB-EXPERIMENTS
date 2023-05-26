<?php
class User
{
    public function get_data($username)
    {
        $query="select * from users where username='$username' limit 1";
        $DB=new DataBase();
        $result=$DB->read($query);
        if($result)
        {
            $row=$result[0];
            return $row;
        }else{
            return false;
        }
    }
    public function get_user($username){
        $query="select * from users where username='$username' limit 1";
        $DB= new DataBase();
        $result=$DB->read($query);

        if($result){
            return $result[0];
        }else{
            return false;
        }
    }
    public function get_friends($username){
        $query="select * from users where username !='$username' ";
        $DB= new DataBase();
        $result=$DB->read($query);

        if($result){
            return $result;
        }else{
            return false;
        }
    }
}
?>