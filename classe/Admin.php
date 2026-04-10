<?php
namespace classe ;

class Admin{

    private $username = "admin";
    private $password = '$2y$10$efmopVCSDFV/aIvMuqtbte0Rabfzr3rRU.yIijIlS9pxGGTYw3ytu';

    public function connect($username, $password): array
    {
        $error = [];
        if(empty($username)){
            $error[] = "Veuillez entrer votre username";
        }
        if(empty($password)){
            $error[] = "Veuillez entrer votre password";
        }
        if(!empty($username) && !empty($password) && $username !== $this->username){
            $error[] = "Username incorrect";
        }
        if(!empty($password) && !empty($username) && !password_verify($password, $this->password)){
            $error[] = "Password incorrect";
        }
        return $error;
    }
        


}