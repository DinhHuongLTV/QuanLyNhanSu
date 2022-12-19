<?php
session_start();
require_once "app/controllers/Controller.php";
require_once "app/models/PostionModel.php";
class PositionController extends Controller
{
    public function index()
    {
        $position_model = new PositionModel();
        $data['data'] = $position_model->getAll();
        $data['page_title'] = "Danh sách chức vụ";
        $data['content'] = 'position/index';
        $this->render('layouts/main', $data);
    }

    public function create()
    {
        $position_model = new PositionModel();

        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            if (empty($name)) {
                $_SESSION['error'] = "Không để trống các trường dấu *";
            }

            if (empty($_SESSION['error'])) {
                $position_model->__ten_cv = $name;
                $is_inserted = $position_model->create();
                if ($is_inserted) {
                    $_SESSION['success'] = "Tạo chức vụ thành công";
                } else {
                    $_SESSION['error'] = "Tạo chức vụ thất bại";
                }
                header("Location: index.php?controller=position&action=index");
                exit();
            }
        }

        $data['content'] = "position/create";
        $data['page_title'] = "Tạo chức vụ mới";
        $this->render("layouts/main", $data);
    }

    public function update()
    {
        $position_model = new PositionModel();

        if (!isset($_GET['MaCV']) || !is_numeric($_GET['MaCV']) || $position_model->getById($_GET['MaCV']) == NULL) {
            $_SESSION['error'] = "Id không hợp lệ";
            header("Location: index.php?controller=position&action=index");
            exit();
        }

        $MaCV = $_GET['MaCV'];
        $data['data'] = $position_model->getById($MaCV);
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            if (empty($name)) {
                $_SESSION['error'] = "Không để trống các trường dấu *";
            }

            if (empty($_SESSION['error'])) {
                $position_model->__ten_cv = $name;
                $is_inserted = $position_model->update($MaCV);
                if ($is_inserted) {
                    $_SESSION['success'] = "Cập nhật chức vụ thành công";
                } else {
                    $_SESSION['error'] = "Cập nhật chức vụ thất bại";
                }
                header("Location: index.php?controller=position&action=index");
                exit();
            }
        }

        $data['content'] = "position/update";
        $data['page_title'] = "Cập nhật chức vụ";
        $this->render("layouts/main", $data);
    }

    public function delete()
    {
        $position_model = new PositionModel();
        if (!isset($_GET['MaCV']) || !is_numeric($_GET['MaCV']) || $position_model->getById($_GET['MaCV']) == NULL) {
            $_SESSION['error'] = "Id không hợp lệ";
            header("Location: index.php?controller=position&action=index");
            exit();
        }

        $MaCV = $_GET['MaCV'];
        $is_deleted = $position_model->delete($MaCV);
        if ($is_deleted) {
            $_SESSION['success'] = "Xóa chức vụ thành công";
        } else {
            $_SESSION['error'] = "Xóa chức vụ thất bại";
        }
        header("Location: index.php?controller=position&action=index");
        exit();
    }
}
