<?php
/**
 * 159.339 Internet Programming Assignment 3
 * Student : Shenchuan Gao (16131180)
 */
?>
<?php
require_once("model/UserHandler.php");

/**
 * Call A Method In A Controller
 * @param $action - controller name
 * @param $method - method name
 */
function call($action, $method)
{
    // require the file that matches the controller name
    require_once('controller/' . $action . 'Controller.php');

    // create a new instance of the called controller
    switch ($action) {
        case 'Default':
            $controller = new DefaultController();
            break;
        case 'UserHome':
            $controller = new UserHomeController();
            break;
        case 'Search':
            $controller = new SearchController();
            break;
        case 'LogIn':
            $controller = new LogInController();
            break;
        case 'Register':
            $controller = new RegisterController();
            break;
    }

    // call the method
    $controller->{$method}();
}

/**
 * Check Login Status
 * If not logged in and attempt to visit protected pages, return false
 * @param $controller - controller name
 * @return boolean
 */
function checkLoginStatus($controller)
{
    $result = FALSE;

    //cookie set and visit pages directly without login
    if (isset($_COOKIE["userName"]) && isset($_COOKIE["secret"]) && !isset($_SESSION["loginUser"])) {
        //check cookie validity
        $userName = $_COOKIE["userName"];
        $secret = $_COOKIE["secret"];
        $handler = new UserHandler();
        $currentUser = $handler->findLoginUserBySecret($userName, $secret);

        //pass checking, recreate session
        if ($currentUser) {
            $_SESSION["loginUser"] = $currentUser;
            $result = True;
        }

    }

    if ($controller != "LogIn" && $controller != "Register" && $controller != "Default"
        && !isset($_SESSION["loginUser"])
    ) {
        //no login & visit protected pages
        $result = FALSE;
    } else {
        $result = True;
    }
    return $result;
}

// controller list with their methods
$controllers = array(
    'Default' => [
        'index', 'error', 'logout'
    ],
    'UserHome' => [
        'showIntro'
    ],
    'Search' => [
        'search',
        'searchByToolName'
    ],
    'LogIn' => [
        'login'
    ],
    'Register' => [
        'register',
        'checkExistedUser'
    ]
);

// check that the requested controller and method are both allowed
// if someone tries to access something else he will be redirected 
// to the error action of the pages controller
// if user not logged in, forward to login page
if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
        if (!checkLoginStatus($controller)) {
            // invalid visit, forward to login page
            header("Location: index.php");
            return;
        }
        call($controller, $action);
    } else {
        call('Default', 'error');
    }
} else {
    call('Default', 'error');
}
?>