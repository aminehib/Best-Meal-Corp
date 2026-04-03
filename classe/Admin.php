<?php
namespace classe ;

class Admin{

    private $username = "admin";
    private $password = "admin" ;

    public function Connect($username , $password):string{
        $error = "";
        if(empty($username)){
            $error = "Username is empty";
        }
        else if(empty($password)){
            $error = "Password is empty";
        }else if($username != $this->username || $password != $this->password){
            $error = "The username or the password are wrong" ;
        }
        return $error ;
    }

   


}