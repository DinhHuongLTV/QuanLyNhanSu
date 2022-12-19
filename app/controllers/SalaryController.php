<?php
session_start();
require_once "app/controllers/Controller.php";
require_once "app/models/SalaryModel.php";
class SalaryController extends Controller
{
    public function index()
    {
        $salary_model = new SalaryModel();
        $data['data'] = $salary_model->getAll();
        $data['page_title'] = "Danh sách bậc lương";
        $data['content'] = 'salary/index';
        $this->render('layouts/main', $data);
    }

    public function create()
    {
        $salary_model = new SalaryModel();

        if (isset($_POST['submit'])) {
            $bacluong = $_POST['bac_luong'];
            $luongCB = $_POST['luong_cb'];
            $heso = $_POST['he_so'];
            $phucap = $_POST['phu_cap'];
            if (empty($bacluong)) {
                $_SESSION['error'] = "Không để trống các trường dấu *";
            }

            if (empty($_SESSION['error'])) {
                $salary_model->__bac_luong = $bacluong;
                $salary_model->__luong_cb = $luongCB;
                $salary_model->__hsl = $heso;
                $salary_model->__phu_cap = $phucap;
                $is_inserted = $salary_model->create();
                if ($is_inserted) {
                    $_SESSION['success'] = "Tạo bậc lương thành công";
                } else {
                    $_SESSION['error'] = "Tạo bậc lương thất bại";
                }
                header("Location: index.php?controller=salary&action=index");
                exit();
            }
        }

        $data['content'] = "salary/create";
        $data['page_title'] = "Tạo bậc lương mới";
        $this->render("layouts/main", $data);
    }

    public function update()
    {
        $salary_model = new SalaryModel();

        if (!isset($_GET['BacLuong']) || !is_numeric($_GET['BacLuong']) || $salary_model->getById($_GET['BacLuong']) == NULL) {
            $_SESSION['error'] = "Id không hợp lệ";
            header("Location: index.php?controller=salary&action=index");
            exit();
        }

        $BacLuong = $_GET['BacLuong'];
        $data['data'] = $salary_model->getById($BacLuong);
        if (isset($_POST['submit'])) {
            $bacluong = $_POST['bac_luong'];
            $luongCB = $_POST['luong_cb'];
            $heso = $_POST['he_so'];
            $phucap = $_POST['phu_cap'];
            if (empty($bacluong)) {
                $_SESSION['error'] = "Không để trống các trường dấu *";
            }

            if (empty($_SESSION['error'])) {
                $salary_model->__bac_luong = $bacluong;
                $salary_model->__luong_cb = $luongCB;
                $salary_model->__hsl = $heso;
                $salary_model->__phu_cap = $phucap;
                $is_inserted = $salary_model->update($BacLuong);
                if ($is_inserted) {
                    $_SESSION['success'] = "Cập nhật bậc lương thành công";
                } else {
                    $_SESSION['error'] = "Cập nhật bậc lương thất bại";
                }
                header("Location: index.php?controller=salary&action=index");
                exit();
            }
        }

        $data['content'] = "salary/update";
        $data['page_title'] = "Cập nhật bậc lương";
        $this->render("layouts/main", $data);
    }

    public function delete()
    {
        $salary_model = new SalaryModel();
        if (!isset($_GET['BacLuong']) || !is_numeric($_GET['BacLuong']) || $salary_model->getById($_GET['BacLuong']) == NULL) {
            $_SESSION['error'] = "Id không hợp lệ";
            header("Location: index.php?controller=salary&action=index");
            exit();
        }

        $BacLuong = $_GET['BacLuong'];
        $is_deleted = $salary_model->delete($BacLuong);
        if ($is_deleted) {
            $_SESSION['success'] = "Xóa bậc lương thành công";
        } else {
            $_SESSION['error'] = "Xóa bậc lương thất bại";
        }
        header("Location: index.php?controller=salary&action=index");
        exit();
    }
}
