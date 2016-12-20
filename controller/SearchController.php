<?php

/**
 * 159.339 Internet Programming Assignment 3
 * Student : Shenchuan Gao (16131180)
 */
require_once 'model/Tool.php';
require_once 'model/CustomedException.php';

/**
 * Search Tools Controller
 */
class SearchController
{

    public function search()
    {
        require_once('view/Search.php');
        require_once ('model/ToolHandler.php');
    }

}

