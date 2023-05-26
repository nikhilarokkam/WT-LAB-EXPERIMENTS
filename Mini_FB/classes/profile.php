<?php
class Profile{
    public function get_profile($username){
        $DB=new DataBase();
        $query="select * from users where username='$username' limit 1";
        return $DB->read($query);
    }
}
?>