<?php

/**
 * 159.339 Internet Programming Assignment 3
 * Student : Shenchuan Gao (16131180)
 */

/**
 * User class
 * Contains information of user.
 */
class User
{
    // User Id
    private $id = NULL;
    // Name
    private $name = NULL;
    // User Name
    private $userName = NULL;
    // Password
    private $password = NULL;
    // Salt
    private $salt = NULL;
    // Email Address
    private $emailAddress = NULL;

    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }

    public function getName(){
        return $this->name;
    }
    public function setName($name){
        $this->name = $name;
    }
    
    public function getUserName(){
        return $this->userName;
    }
    public function setUserName($userName){
        $this->userName = $userName;
    }
    
    public function getPassword(){
        return $this->password;
    }
    public function setPassword($password){
        $this->password = $password;
    }
    
    public function getSalt(){
        return $this->salt;
    }
    public function setSalt($salt){
        $this->salt = $salt;
    }

    public function getEmailAddress(){
        return $this->emailAddress;
    }
    public function setEmailAddress($emailAddress){
        $this->emailAddress = $emailAddress;
    }

}
