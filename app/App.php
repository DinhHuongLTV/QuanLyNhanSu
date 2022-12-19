<?php
class App
{
    public $__controller, $__action;
    public function __construct()
    {
        $this->__controller = "employee";
        $this->__action = "index";
        $this->urlHandler();
    }

    public function urlHandler()
    {
        if (isset($_GET['controller'])) {
            $this->__controller = $_GET['controller'];
        }

        if (file_exists("app/controllers/" . $this->__controller . "Controller.php")) {
            require_once "app/controllers/" . $this->__controller . "Controller.php";
            $controller = ucfirst($this->__controller) . "Controller";
            if (class_exists($controller)) {
                $this->__controller = new $controller();
            } else {
                $this->loadError();
            }
        }

        if (isset($_GET['action'])) {
            $this->__action = $_GET['action'];
        }

        if (method_exists($this->__controller, $this->__action)) {
            call_user_func_array([$this->__controller, $this->__action], []);
        } else {
            $this->loadError();
        }
    }

    public function loadError($name = "404")
    {
        require_once "app/views/errors/" . $name . ".php";
    }
}
