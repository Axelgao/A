<?php
/**
 * 159.339 Internet Programming Assignment 3
 * Student : Shenchuan Gao (16131180)
 */
?>
<?php
require_once ('model/LoginUser.php');
require_once ('model/Db.php');

if (! isset($_SESSION)) {
    session_start();
}

if (isset($_REQUEST['action']) && isset($_REQUEST['method'])) {
    $controller = $_REQUEST['action'];
    $action = $_REQUEST['method'];
} else {
    $controller = 'Default';
    $action = 'index';
}

// if logged in
if (isset($_SESSION["loginUser"])) {
    require_once ('view/HomeLayout.php');
} else {
    // if not
    require_once ('view/LoginLayout.php');
}
?>