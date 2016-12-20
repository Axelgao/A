<?php

/**
 * 159.339 Internet Programming Assignment 3
 * Student : Shenchuan Gao (16131180)
 */
require_once("User.php");
require_once("CustomedException.php");

/**
 * User handler class
 * Contains functions to handle users
 */
class UserHandler
{

    public function checkExistedUser($userName)
    {
        $db = Db::connect();
        if ($db->connect_errno) {
            die("Connection failed: (" . $db->connect_error . ")" . $db->connect_error);
        }

        // check user login name duplicated
        $tempUser = $this->getUserByUserName($db, $userName);
        if (isset($tempUser)) {
            return $tempUser;
        }
    }

    /**
     * New User Register
     *
     * @param User $user
     */
    public function Register($user)
    {
        // connection database
        $db = Db::connect();
        if ($db->connect_errno) {
            die("Connection failed: (" . $db->connect_error . ")" . $db->connect_error);
        }

        // check user login name duplicated
        $tempUser = $this->getUserByUserName($db, $user->getUserName());
        if (isset($tempUser)) {
            throw new DuplicatedRecordException("Duplicated user name.");
        }

        // create salt
        $salt = rand(0, 999999);
        $saltText = sprintf("%06d", $salt);
        $user->setSalt($saltText);
        $password = $this->hashPassword($user->getPassword(), $saltText);
        $user->setPassword($password);

        // begin transaction
        $db->begin_transaction();

        // insert
        $query = <<<SQL
            INSERT INTO tbl_user
            (user_name, full_name, password, salt, email_address )
            VALUES(?, ?, ?, ?, ?)
SQL;
        $stmt = $db->prepare($query);
        if ($stmt) {

            $stmt->bind_param('sssss', $userName, $name, $password, $saltText, $emailAddress);

            $userName = $user->getUserName();
            $name = $user->getName();
            $emailAddress = $user->getEmailAddress();

            if ($stmt->execute() == FALSE) {
                $no = $db->errno;
                $err = $db->error;
                $db->rollback();
                $db->close();
                throw new Exception("Insert failed: (" . $no . ")" . $err);
            }

            // get new id
            $id = $db->insert_id;
            $stmt->close();

            $db->commit();
        } else {
            $no = $db->errno;
            $err = $db->error;
            $db->rollback();
            $db->close();
            throw new Exception("Prepare failed: (" . $no . ")" . $err);
        }

        $db->close();
        return $id;
    }

    /**
     * Login with User Name and Password
     *
     * @param $userName - user name
     * @param $password - password
     * @return CurrentUser or false
     */
    public function login($userName, $password)
    {
        $currentUser = FALSE;

        // connection database
        $db = Db::connect();
        if ($db->connect_errno) {
            die("Connection failed: (" . $db->connect_error . ")" . $db->connect_error);
        }

        // find uesr information by login name
        $user = $this->getUserByUserNameAndPassword($db, $userName, $password);
        if (isset($user)) {
            $currentUser = new LoginUser();
            $currentUser->setId($user->getId());
            $currentUser->setUserName($user->getUserName());
            $currentUser->setTimeOfLogin(date("Y-m-d h:i:sa"));

            // calculate cookie secret
            $key = $this->calculateSecret($user->getId(), $user->getSalt());
            $currentUser->setSecret($key);
        }

        $db->close();
        return $currentUser;
    }

    /**
     * Check user id and secret
     *
     * @param $userName - user name
     * @param $secret - secret string
     * @return CurrentUser or false
     */
    public function findLoginUserBySecret($userName, $secret)
    {
        $currentUser = FALSE;

        // connection database
        $db = Db::connect();
        if ($db->connect_errno) {
            die("Connection failed: (" . $db->connect_error . ")" . $db->connect_error);
        }

        // find uesr information by user name
        $user = $this->getUserByUserName($db, $userName);
        if (isset($user)) {
            // calculate cookie secret
            $key = $this->calculateSecret($user->getId(), $user->getSalt());
            if ($key == $secret) {
                $currentUser = new LoginUser();
                $currentUser->setId($user->getId());
                $currentUser->setUserName($user->getUserName());
                $currentUser->setTimeOfLogin(date("Y-m-d h:i:sa"));
                $currentUser->setSecret($key);
            }
        }

        $db->close();
        return $currentUser;
    }

    /**
     * Login with User Name and Password
     *
     * @param $db - database connection
     * @param $userName - user name
     * @param $password - password
     * @return CurrentUser or NULL
     */
    private function getUserByUserNameAndPassword($db, $userName, $password)
    {
        $user = NULL;

        // find user information by user name
        $tempUser = $this->getUserByUserName($db, $userName);
        if (!isset($tempUser)) {
            throw new Exception("Wrong user name or password.");
        }

        // calculate hash of password
        $salt = $tempUser->getSalt();
        $hashPassword = $this->hashPassword($password, $salt);

        $query = <<<SQL
            SELECT id, user_name, full_name, password, salt, email_address
            FROM tbl_user
            WHERE user_name=? AND password=?
SQL;
        $stmt = $db->prepare($query);
        if ($stmt) {
            $stmt->bind_param('ss', $userName, $hashPassword);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id, $newUserName, $name, $newPassword,
                $salt, $emailAddress);
            if ($stmt->fetch()) {
                $user = new User();
                $user->setId($id);
                $user->setUserName($newUserName);
                $user->setName($name);
                $user->setPassword($newPassword);
                $user->setSalt($salt);
                $user->setEmailAddress($emailAddress);
            }
            $stmt->close();
        } else {
            $no = $stmt->errno;
            $err = $stmt->error;
            throw new Exception("Prepare failed: (" . $no . ")" . $err);
        }

        return $user;
    }

    /**
     * Get User By User Name
     *
     * @param $db - database connection
     * @param $userName - user name
     * @return User
     */
    private function getUserByUserName($db, $userName)
    {
        $user = NULL;

        $query = <<<SQL
            SELECT id, user_name, full_name, password, salt, email_address
            FROM tbl_user
            WHERE user_name=?
SQL;
        $stmt = $db->prepare($query);
        if ($stmt) {
            $stmt->bind_param('s', $userName);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id, $newUserName, $name, $password,
                $salt, $emailAddress);
            if ($stmt->fetch()) {
                $user = new User();
                $user->setId($id);
                $user->setUserName($newUserName);
                $user->setName($name);
                $user->setPassword($password);
                $user->setSalt($salt);
                $user->setEmailAddress($emailAddress);
            }
            $stmt->close();
        } else {
            $no = $stmt->errno;
            $err = $stmt->error;
            throw new Exception("Prepare failed: (" . $no . ")" . $err);
        }

        return $user;
    }

    /**
     * calculate secret for cookie
     * @param $userId - user id
     * @param $salt - salt
     * @return string
     */
    private function calculateSecret($userName, $salt)
    {
        $key = $salt . "-" . $userName;
        $key = md5($key);
        return $key;
    }

    /**
     * calculate password hash
     * @param $password - password
     * @param $salt - salt
     * @return string
     */
    private function hashPassword($password, $salt)
    {
        return md5($salt . $password);
    }
}
