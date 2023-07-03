<?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include_once('./connections/core.php');
    include_once('./connections/models.php');
    include_once('./connections/controllers.php');
    include_once('./connections/view.php');


    session_start();
    if(!isset($_COOKIE['id_session'])){
        $_SESSION['id_session'] = uniqid();
        $clientInit = new ClientModel();
        $clientInit->initClientSession($_SESSION['id_session']);
        $_SESSION['id_client'] = $clientInit->getClientId($_SESSION['id_session']);
    } else{
        $_SESSION['id_session'] = $_COOKIE['id_session'];
        $clientInit = new ClientModel();
        $_SESSION['id_client'] = $clientInit->getClientId($_SESSION['id_session']);
        if(!$_SESSION['id_client']){
            $_SESSION['id_session'] = uniqid();
            $clientInit->initClientSession($_SESSION['id_session']);
            $_SESSION['id_client'] = $clientInit->getClientId($_SESSION['id_session']);
        }
    }

    setcookie('id_session', $_SESSION['id_session'], 0, '/');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controller = new PostController();
        $JSON = $controller->handleRequest($_POST);
        echo $JSON;
        exit();
    }

    

    $segment = $SPLIT[0] ?? 'main';
    $controll_name = ucfirst($segment) . 'Controller';
    if(class_exists($controll_name)){
        $controller = new $controll_name();
        $controller->Action();
    } else {
        $errorController = new ErrorController();
        $errorController->Action();
    }
    
?>