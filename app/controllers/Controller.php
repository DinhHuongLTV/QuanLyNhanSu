<?php

class Controller
{
    public $__controller, $__action;

    public function __construct()
    {
        $controller = isset($_GET['controller']) ? $_GET['controller'] : "user";
        $action = isset($_GET['action']) ? $_GET['action'] : "index";
        if (
            !isset($_SESSION['user'])
            && strcmp($controller, "login") && !in_array($action, ['login', 'signup'])
        ) {
            $_SESSION['error'] = "Bạn phải đăng nhập";
            header("Location: index.php?controller=login&action=login");
            exit();
        }
    }

    public function render($url, $data = [])
    {
        # code...
        $view = "app/views/" . $url . ".php";
        extract($data);
        if (file_exists($view)) {
            require_once $view;
        } else {
            echo "error while requiring";
        }
    }
}
