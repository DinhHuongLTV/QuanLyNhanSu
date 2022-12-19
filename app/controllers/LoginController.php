<?php
session_start();
require_once "app/controllers/Controller.php";
require_once "app/models/UserModel.php";
class LoginController extends Controller
{
    public function login()
    {
        //        nếu đăng nhập rồi thì chuyển hướng backend
        if (isset($_SESSION['user'])) {
            header("Location: index.php?controller=employee&action=index");
            exit();
        }

        // echo "<pre>";
        // print_r($_POST);
        // echo "</pre>";
        if (isset($_POST['submit'])) {
            $user_model = new UserModel();
            $username  = $_POST['username'];
            $password  = $_POST['password'];

            if (empty($username) || empty($password)) {
                $_SESSION['error'] = "Tên đăng nhập / mật khẩu không để trống";
            }

            if (empty($_SESSION['error'])) {
                $existed_user = $user_model->getByName($username);
                // echo "<pre>";
                // print_r($existed_user);
                // echo "</pre>";
                if (empty($existed_user)) {
                    $_SESSION['error'] = "Người dùng không tồn tại";
                } else {
                    $is_same = strcmp($password, $existed_user['password']);
                    if ($is_same) {
                        $_SESSION['error'] = "Sai mật khẩu";
                    } else {
                        $_SESSION['success'] = "Đăng nhập thành công";
                        $_SESSION['user'] = $existed_user;
                        header("Location: index.php?controller=employee");
                        exit();
                    }
                }
            }
        }
        $data['page_title'] = "Đăng nhập";
        $data['content'] = "login/login";
        $this->render("layouts/main_login", $data);
    }

    public function signup()
    {
        if (isset($_SESSION['user'])) {
            header("Location: index.php?controller=user&action=index");
            exit();
        }
        if (isset($_POST['submit'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $password_confirm = $_POST['password_confirm'];
            if (empty($username) || empty($password)) {
                $_SESSION['error'] = "Không để trống tên ĐN / MK";
            } else if (strlen($username) < 5 || strlen($password) < 5) {
                $_SESSION['error'] = "Tên ĐN / MK quá ngắn";
            } else if (empty($password_confirm)) {
                $_SESSION['error'] = "Chưa xác nhận lại mật khẩu";
            } else if (strcmp($password_confirm, $password)) {
                $_SESSION['error'] = "Mật khẩu không trùng khớp";
            } else if ((new UserModel())->getByName($username) != NULL) {
                $_SESSION['error'] = "Tên đãng nhập đã được dùng";
            }

            if (empty($_SESSION)) {
                $user_model = new UserModel();
                $user_model->__username = $username;
                $user_model->__password = $password;
                $is_created = $user_model->create();
                if ($is_created) {
                    $_SESSION['success'] = "Đăng nhập bằng tài khoản vừa tạo";
                    header("Location: index.php?controller=login&action=login");
                    exit();
                } else {
                    $_SESSION['error'] = "Không tạo được";
                }
            }
        }
        $data['page_title'] = "Đăng ký quản trị viên";
        $data['content'] = "login/signup";
        $this->render('layouts/main_login', $data);
    }

    public function signout()
    {
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
        }
        if (isset($_COOKIE['user'])) {
            setcookie('user', "", time() - 1);
        }
        $_SESSION['success'] = "Đăng xuất thành công";
        header("Location: index.php?controller=login&action=login");
    }
}
