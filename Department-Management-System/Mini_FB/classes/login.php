<?php
class Login{
    private $error="";
    public function evaluate($data)
    {
        $username=addslashes(ucfirst($data['username']));
        $password=addslashes($data['password']);
        $query="select * from users where username='$username' limit 1";
        $DB=new DataBase();
        $result=$DB->read($query);

        if($result)
        {
            $row=$result[0];
            if($password==$row['password']){
                //create session data
                $_SESSION['facebook_username']=$row['username'];
            }else{
                $this->error .= "wrong password<br>";
            }
        }
            else{
                $this->error .= "No such username was found<br>";
            }
        
        return $this->error;
    }
    public function check_login($username)
    {
        
        $query="select * from users where username='$username' limit 1";
        $DB=new DataBase();
        $result=$DB->read($query);

        if($result)
        {
            $user_data=$result[0];
            return $user_data;
        }
        else{
            header("Location:login.php");
            die;
            }
        }

}
?>