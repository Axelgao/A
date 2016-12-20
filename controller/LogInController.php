<?php

/**1
 * 159.339 Internet Programming Assignment 3
 * Team Student 2: Shenchuan Gao (16131180)
 */
require_once 'model/UserHandler.php';
require_once 'model/User.php';
require_once 'model/LoginUser.php';
require_once 'model/CustomedException.php';

/**
 * Log In Controller
 * Provides log in function
 */
class LogInController
{
    // user handler object
    private $userHandler;

    function __construct()
    {
        $this->userHandler = new UserHandler();
    }

    /**
     * log in
     * @throws InputRequiredException
     */
    public function login()
    {
        try {
            // check input
            if (! isset($_POST["ID"])) {
                throw new InputRequiredException("Login name is required.");
            }
            if (! isset($_POST["password"])) {
                throw new InputRequiredException("Password is required.");
            }

            
            $userName = $_POST["ID"];
            $userPassword = $_POST["password"];

            // check user login name and password
            $login = $this->userHandler->login($userName, $userPassword);
            
            if ($login) {
                // login succeed, get loginUser object
                $_SESSION["loginUser"] = $login;
                
                // set cookie
                setcookie("loginName", $login->getUserName(), time() + (86400 * 7), "/"); // 86400 = 1 day
                setcookie("secret", $login->getSecret(), time() + (86400 * 7), "/"); // 86400 = 1 day
                
                // forward to user home page
                header('Location: ' . "index.php?action=UserHome&method=showIntro");
                return;
            } else {
                $errorMessage = "Wrong login name or password.";
                require_once ('view/LogIn.php');
            }
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            require_once ('view/LogIn.php');
            return;
        }
    }
}
?>
