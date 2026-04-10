<?php
namespace classe ;

class Admin{

    private $username = "admin";
    private $password = '$2y$10$efmopVCSDFV/aIvMuqtbte0Rabfzr3rRU.yIijIlS9pxGGTYw3ytu';

    public function connect($username, $password): string {
        $error = "";
        if(empty($username)){
            $error = "Username is empty";
        } else if(empty($password)){
            $error = "Password is empty";
        } else if($username !== $this->username || !password_verify($password, $this->password)){
            $error = "The username or the password are wrong";
        }
        return $error;
    }


}