<?php
session_start();
require_once "app/controllers/Controller.php";
require_once "app/models/UserModel.php";
class UserController extends Controller
{
    public function index()
    {
        $user_model = new UserModel();
        $data['data'] = $user_model->getAll();
        $data['page_title'] = "Danh sách user";
        $data['content'] = 'user/index';
        $this->render('layouts/main', $data);
    }

    public function create()
    {
        $user_model = new UserModel();
        if (isset($_POST['submit'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $password_confirm  = $_POST['password_confirm'];
            $avatar = $_FILES['avatar'];
            if (empty($username) || empty($password) || empty($password_confirm)) {
                $_SESSION['error'] = "Không để trống các trường dấu *";
            } else if ($user_model->getByName($username) != NUll) {
                $_SESSION['error'] = "Tên đã được dùng";
            } else if (strlen($password) < 5) {
                $_SESSION['error'] = "Mật khẩu quá ngắn (Mật khẩu lớn hơn 5 ký tự)";
            } else if (strcmp($password, $password_confirm) != 0) {
                $_SESSION['error'] = "Mật khẩu không trùng khớp";
            }
            if ($avatar['error'] == 0) {
                $filename_extension = ['png', 'jpg', 'jpeg'];
                $extension = strtolower(pathinfo($avatar['name'], PATHINFO_EXTENSION));
                $file_size_mb = round($avatar['size'] / 1024 / 1024, 2);
                if (!in_array($extension, $filename_extension)) {
                    $_SESSION['error'] = "Ảnh không đúng định dạng";
                } else if ($file_size_mb > 2) {
                    $_SESSION['error'] = "Kích thước ảnh quá lớn (chọn ảnh nhỏ hơn 2mb)";
                }
            }

            if (empty($_SESSION['error'])) {
                // upload avatar
                $filename = "placeholder.png";
                if ($avatar['error'] == 0) {
                    $dir_upload = "assets/uploads";
                    if (!file_exists($dir_upload)) {
                        mkdir($dir_upload);
                    }
                    $filename = time() . "-user-" . $avatar['name'];
                    move_uploaded_file($avatar['tmp_name'], $dir_upload . '/' . $filename);
                }
                // gọi model
                $user_model->__username = $username;
                $user_model->__password = $password;
                $user_model->__avatar = $filename;
                $is_inserted = $user_model->create();
                if ($is_inserted) {
                    $_SESSION['success'] = "Thêm user thành công";
                } else {
                    $_SESSION['error'] = "Thêm user thất bại";
                }
                header("Location: index.php?controller=employee&action=index");
                exit();
            }
        }

        // gọi view
        $data['content'] = 'user/create';
        $data['page_title'] = "Tạo người dùng";
        $this->render('layouts/main', $data);
    }

    public function update()
    {
        $user_model = new UserModel();
        if (!isset($_GET['id']) || !is_numeric($_GET['id']) || $user_model->getById($_GET['id']) == NULL) {
            $_SESSION['error'] = "Id không hợp lệ";
            header("Location: index.php?controller=employee");
            exit();
        }
        $id = $_GET['id'];
        $data['data'] = $user_model->getById($id);
        if (isset($_POST['submit'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $avatar = $_FILES['avatar'];
            if (empty($username) || empty($password)) {
                $_SESSION['error'] = "Không để trống các trường dấu *";
            } else if (strlen($password) < 5) {
                $_SESSION['error'] = "Mật khẩu quá ngắn (Mật khẩu lớn hơn 5 ký tự)";
            }
            if ($avatar['error'] == 0) {
                $filename_extension = ['png', 'jpg', 'jpeg'];
                $extension = strtolower(pathinfo($avatar['name'], PATHINFO_EXTENSION));
                $file_size_mb = round($avatar['size'] / 1024 / 1024, 2);
                if (!in_array($extension, $filename_extension)) {
                    $_SESSION['error'] = "Ảnh không đúng định dạng";
                } else if ($file_size_mb > 2) {
                    $_SESSION['error'] = "Kích thước ảnh quá lớn (chọn ảnh nhỏ hơn 2mb)";
                }
            }

            if (empty($_SESSION['error'])) {
                // upload avatar
                $filename = $data['data']['avatar'];
                if ($avatar['error'] == 0) {
                    $dir_upload = "assets/uploads";
                    if (!file_exists($dir_upload)) {
                        mkdir($dir_upload);
                    }
                    $filename = time() . "-user-" . $avatar['name'];
                    move_uploaded_file($avatar['tmp_name'], $dir_upload . '/' . $filename);
                }
                // gọi model
                $user_model->__username = $username;
                $user_model->__password = $password;
                $user_model->__avatar = $filename;
                $is_inserted = $user_model->update($id);
                if ($is_inserted) {
                    $_SESSION['success'] = "Thêm user thành công";
                } else {
                    $_SESSION['error'] = "Thêm user thất bại";
                }
                header("Location: index.php?controller=employee&action=index");
                exit();
            }
        }
        // gọi view
        $data['content'] = 'user/update';
        $data['page_title'] = "Cập nhật user";
        $this->render('layouts/main', $data);
    }

    public function detail()
    {
        $user_model = new UserModel();
        if (!isset($_GET['id']) || !is_numeric($_GET['id']) || $user_model->getById($_GET['id']) == NULL) {
            $_SESSION['error'] = "Id không hợp lệ";
            header("Location: index.php?controller=employee");
            exit();
        }
        $id = $_GET['id'];

        $data['data'] = $user_model->getById($id);
        $data['page_title'] = "Thông tin user";
        $data['content'] = 'user/detail';
        $this->render("layouts/main", $data);
    }
}
