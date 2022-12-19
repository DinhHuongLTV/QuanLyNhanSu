<?php
session_start();
require_once "app/controllers/Controller.php";
require_once "app/models/DepartmentModel.php";
class DepartmentController extends Controller
{

    public function index()
    {
        $department_model = new DepartmentModel();
        $data['data'] = $department_model->getAll();
        $data['page_title'] = "Danh sách phòng ban";
        $data['content'] = 'department/index';
        $this->render('layouts/main', $data);
    }

    public function create()
    {
        $department_model = new DepartmentModel();

        // echo "<pre>";
        // print_r($_POST);
        // echo "</pre>";
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $address = $_POST['address'];
            $phone = $_POST['phone'];
            if (empty($name) || empty($address) || empty($phone)) {
                $_SESSION['error'] = "Không để trống các trường dấu *";
            }

            if (empty($_SESSION['error'])) {
                $department_model->__ten_pb = $name;
                $department_model->__dia_chi = $address;
                $department_model->__sdt = $phone;
                $is_inserted = $department_model->create();
                if ($is_inserted) {
                    $_SESSION['success'] = "Thêm phòng ban thành công";
                } else {
                    $_SESSION['error'] = "Thêm phòng ban thất bại";
                }
                header("Location: index.php?controller=department&action=index");
                exit();
            }
        }

        $data['content'] = "department/create";
        $data['page_title'] = "Thêm phòng ban";
        $this->render("layouts/main", $data);
    }

    public function update()
    {
        $department_model = new DepartmentModel();

        if (!isset($_GET['MaPB']) || !is_numeric($_GET['MaPB']) || $department_model->getById($_GET['MaPB']) == NULL) {
            $_SESSION['error'] = "Id không hợp lệ";
            header("Location: index.php?controller=department&action=index");
            exit();
        }

        $MaPB = $_GET['MaPB'];
        $data['department'] = $department_model->getById($MaPB);
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $address = $_POST['address'];
            $phone = $_POST['phone'];
            if (empty($name) || empty($address) || empty($phone)) {
                $_SESSION['error'] = "Không để trống các trường dấu *";
            }

            if (empty($_SESSION['error'])) {
                $department_model->__ten_pb = $name;
                $department_model->__dia_chi = $address;
                $department_model->__sdt = $phone;
                $is_inserted = $department_model->update($MaPB);
                if ($is_inserted) {
                    $_SESSION['success'] = "Cập nhật phòng ban thành công";
                } else {
                    $_SESSION['error'] = "Cập nhật phòng ban thất bại";
                }
                header("Location: index.php?controller=department&action=index");
                exit();
            }
        }

        $data['content'] = "department/update";
        $data['page_title'] = "Tạo phòng ban mới";
        $this->render("layouts/main", $data);
    }

    public function delete()
    {
        $department_model = new DepartmentModel();
        if (!isset($_GET['MaPB']) || !is_numeric($_GET['MaPB']) || $department_model->getById($_GET['MaPB']) == NULL) {
            $_SESSION['error'] = "Id không hợp lệ";
            header("Location: index.php?controller=department&action=index");
            exit();
        }

        $MaPB = $_GET['MaPB'];
        $is_deleted = $department_model->delete($MaPB);
        if ($is_deleted) {
            $_SESSION['success'] = "Xóa phòng ban thành công";
        } else {
            $_SESSION['error'] = "Xóa phòng ban thất bại";
        }
        header("Location: index.php?controller=department&action=index");
        exit();
    }
}
