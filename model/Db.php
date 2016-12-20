<?php

/**
 * 159.339 Internet Programming Assignment 3
 * Student : Shenchuan Gao (16131180)
 */

/**
 * Database Connection Class
 * Provides database connection function
 */
class Db
{
    private function __construct()
    {}

    private function __clone()
    {}

    /**
     * Connect Database and Return Database Connection Object
     */
    public static function connect()
    {
        $database_server = "localhost";
        $database_name = "a3";
        $database_user = "a3";
        $database_password = "a3";
        
        // connect database
        $db = new mysqli($database_server, $database_user, $database_password, $database_name);
        $db->autocommit(FALSE);
        return $db;
    }
}


