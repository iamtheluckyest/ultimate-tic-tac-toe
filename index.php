<?php
    
    include_once 'models/Request.php';
    include_once 'startGame.php';
    include_once 'utils/printBoard.php';
    
    spl_autoload_register('apiAutoload');
    
    
    function apiAutoload($classname)
    {
        if (preg_match('/[a-zA-Z]+Controller$/', $classname)) {
            include __DIR__ . '/controllers/' . $classname . '.php';
            return true;
        } 
        elseif (preg_match('/[a-zA-Z]+Model$/', $classname)) {
            include __DIR__ . '/models/' . $classname . '.php';
            return true;
        } 
        elseif (preg_match('/[a-zA-Z]+View$/', $classname)) {
            include __DIR__ . '/views/' . $classname . '.php';
            return true;
        }
    }
    
    $request = new Request();
    
    //i.e. BoardController
    $controller_name = ucfirst($request->url_elements[1]) . 'Controller';
    
    if (class_exists($controller_name)) {
        $controller = new $controller_name();
        $action_name = strtolower($request->verb) . 'Action';
        $response = $controller->$action_name($request, $_SESSION["gameBoard"]);
        print_r($response);
    }
    
?>

