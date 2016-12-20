<?php

/**
 * 159.339 Internet Programming Assignment 3
 * Student : Shenchuan Gao (16131180)
 */

/**
 * Current Login User class
 * Contains information of current login user.
 */
class LoginUser
{
    // User Id
    private $id = NULL;
    // User Name
    private $userName = NULL;
    // Secret
    private $secret = NULL;
    // Time of Login
    private $timeOfLogin = NULL;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getUserName()
    {
        return $this->userName;
    }

    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    public function getSecret()
    {
        return $this->secret;
    }

    public function setSecret($secret)
    {
        $this->secret = $secret;
    }

    public function getTimeOfLogin()
    {
        return $this->timeOfLogin;
    }

    public function setTimeOfLogin($timeOfLogin)
    {
        $this->timeOfLogin = $timeOfLogin;
    }
}
