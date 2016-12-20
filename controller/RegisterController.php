<?php

/**
 * 159.339 Internet Programming Assignment 3
 * Student : Shenchuan Gao (16131180)
 */
require_once 'model/UserHandler.php';
require_once 'model/User.php';

/**
 * New User Join Controller
 * Provides user register function
 */
class RegisterController
{
    // user handler object
    private $userHandler;

    function __construct()
    {
        $this->userHandler = new UserHandler();
    }

    /**
     * New user register
     * @throws InputRequiredException
     * @throws DataTooLongException
     * @throws Exception
     * @throws InvalidDataFormatException
     */
    public function register()
    {
        $user = new User();

        if (isset($_POST["submit"])) {
            try {
                $userName = $_POST["userName"];
                $name = $_POST["name"];
                $emailAddress = $_POST["emailAddress"];
                $password = $_POST["password"];

                $user->setUserName($userName);
                $user->setName($name);
                $user->setEmailAddress($emailAddress);
                $user->setPassword($password);

                // check input
                if (!isset($userName) || strlen($userName) == 0) {
                    throw new InputRequiredException("User name is required.");
                }
                if (!isset($name) || strlen($name) == 0) {
                    throw new InputRequiredException("Name is required.");
                }
                if (!isset($emailAddress) || strlen($emailAddress) == 0) {
                    throw new InputRequiredException("Address is required.");
                }
                if (strlen($emailAddress) > 255) {
                    throw new DataTooLongException("Address should be less than 255.");
                }

                //create new user in database
                $ret = $this->userHandler->register($user);
                if ($ret) {
                    require_once('view/RegisterResult.php');
                } else {
                    require_once('view/Register.php');
                }
            } catch (Exception $e) {
                $errorMessage = $e->getMessage();
                require_once('view/Register.php');
                return;
            }
        } else {
            require_once('view/Register.php');
        }
    }

    public function checkExistedUser()
    {
        $userName = $_GET['userName'];
        $existedUser=$this->userHandler->checkExistedUser($userName);
        if(isset($existedUser)){
            echo "Invalid username!";
        };
    }
}

?>
