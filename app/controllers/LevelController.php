<?php
session_start();
require_once "app/controllers/Controller.php";
require_once "app/models/LevelModel.php";

class LevelController extends Controller
{
    public function index()
    {
        $lelvel_model = new LevelModel();
        $data['data'] = $lelvel_model->getAll();
        $data['page_title'] = "Danh sách trình độ học vấn";
        $data['content'] = 'level/index';
        $this->render('layouts/main', $data);
    }

    public function create()
    {
        $lelvel_model = new LevelModel();

        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $major = $_POST['major'];
            if (empty($name) || empty($major)) {
                $_SESSION['error'] = "Không để trống các trường dấu *";
            }

            if (empty($_SESSION['error'])) {
                $lelvel_model->__ten_tdhv = $name;
                $lelvel_model->__cnganh = $major;
                $is_inserted = $lelvel_model->create();
                if ($is_inserted) {
                    $_SESSION['success'] = "Tạo trình độ học vấn thành công";
                } else {
                    $_SESSION['error'] = "Tạo trình độ học vấn thất bại";
                }
                header("Location: index.php?controller=level&action=index");
                exit();
            }
        }

        $data['content'] = "level/create";
        $data['page_title'] = "Tạo trình độ học vấn mới";
        $this->render("layouts/main", $data);
    }

    public function update()
    {
        $lelvel_model = new LevelModel();

        if (!isset($_GET['MaTDHV']) || !is_numeric($_GET['MaTDHV']) || $lelvel_model->getById($_GET['MaTDHV']) == NULL) {
            $_SESSION['error'] = "Id không hợp lệ";
            header("Location: index.php?controller=level&action=index");
            exit();
        }

        $MaTDHV = $_GET['MaTDHV'];
        $data['data'] = $lelvel_model->getById($MaTDHV);
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $major = $_POST['major'];
            if (empty($name) || empty($major)) {
                $_SESSION['error'] = "Không để trống các trường dấu *";
            }

            if (empty($_SESSION['error'])) {
                $lelvel_model->__ten_tdhv = $name;
                $lelvel_model->__cnganh = $major;
                $is_inserted = $lelvel_model->update($MaTDHV);
                if ($is_inserted) {
                    $_SESSION['success'] = "Cập nhật trình độ học vấn thành công";
                } else {
                    $_SESSION['error'] = "Cập nhật trình độ học vấn thất bại";
                }
                header("Location: index.php?controller=level&action=index");
                exit();
            }
        }

        $data['content'] = "level/update";
        $data['page_title'] = "Cập nhật trình độ học vấn mới";
        $this->render("layouts/main", $data);
    }

    public function delete()
    {
        $lelvel_model = new LevelModel();
        if (!isset($_GET['MaTDHV']) || !is_numeric($_GET['MaTDHV']) || $lelvel_model->getById($_GET['MaTDHV']) == NULL) {
            $_SESSION['error'] = "Id không hợp lệ";
            header("Location: index.php?controller=level&action=index");
            exit();
        }

        $MaTDHV = $_GET['MaTDHV'];
        $is_deleted = $lelvel_model->delete($MaTDHV);
        if ($is_deleted) {
            $_SESSION['success'] = "Xóa trình độ học vấn thành công";
        } else {
            $_SESSION['error'] = "Xóa trình độ học vấn thất bại";
        }
        header("Location: index.php?controller=level&action=index");
        exit();
    }
}
