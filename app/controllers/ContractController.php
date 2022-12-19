<?php
session_start();
require_once "app/controllers/Controller.php";
require_once "app/models/ContractModel.php";
require_once "app/models/EmployeeModel.php";
class ContractController extends Controller
{
    public function index()
    {
        $contract_model = new ContractModel();
        $employee_model = new EmployeeModel();
        $data['data']['employees'] = $employee_model->getAll();
        $data['data']['contracts'] = $contract_model->getAll();
        $data['page_title'] = "Danh sách hợp đồng";
        $data['content'] = 'contract/index';
        $this->render('layouts/main', $data);
    }

    public function create()
    {
        $contract_model = new ContractModel();
        $employee_model = new EmployeeModel();

        if (isset($_POST['submit'])) {
            $employee = $_POST['employee'];
            $duration = $_POST['duration'];
            $from = $_POST['from'];
            $to = $_POST['to'];
            if (empty($employee) || empty($duration) || empty($from) || empty($to)) {
                $_SESSION['error'] = "Không để trống các trường dấu *";
            } else if (!is_numeric($duration) || $duration < 0) {
                $_SESSION['error'] = "Thời hạn là số nguyên dương";
            }

            if (empty($_SESSION['error'])) {
                $contract_model->__ma_nv = $employee;
                $contract_model->__thoi_han = $duration;
                $contract_model->__tu_ngay = $from;
                $contract_model->__den_ngay = $to;
                $is_inserted = $contract_model->create();
                if ($is_inserted) {
                    $_SESSION['success'] = "Tạo hợp đồng thành công";
                } else {
                    $_SESSION['error'] = "Tạo hợp đồng thất bại";
                }
                header("Location: index.php?controller=contract&action=index");
                exit();
            }
        }

        $data['employees'] = $employee_model->getAll();
        $data['content'] = "contract/create";
        $data['page_title'] = "Tạo hợp đồng mới";
        $this->render("layouts/main", $data);
    }

    public function update()
    {
        $contract_model = new ContractModel();
        $employee_model = new EmployeeModel();

        if (!isset($_GET['MaHD']) || !is_numeric($_GET['MaHD']) || $contract_model->getById($_GET['MaHD']) == NULL) {
            $_SESSION['error'] = "Id không hợp lệ";
            header("Location: index.php?controller=contract&action=index");
            exit();
        }

        $MaHD = $_GET['MaHD'];
        $data['data'] = $contract_model->getById($MaHD);
        if (isset($_POST['submit'])) {
            $employee = $_POST['employee'];
            $duration = $_POST['duration'];
            $from = $_POST['from'];
            $to = $_POST['to'];
            if (empty($employee) || empty($duration) || empty($from) || empty($to)) {
                $_SESSION['error'] = "Không để trống các trường dấu *";
            } else if (!is_numeric($duration) || $duration < 0) {
                $_SESSION['error'] = "Thời hạn là số nguyên dương";
            }

            if (empty($_SESSION['error'])) {
                $contract_model->__ma_nv = $employee;
                $contract_model->__thoi_han = $duration;
                $contract_model->__tu_ngay = $from;
                $contract_model->__den_ngay = $to;
                $is_inserted = $contract_model->update($MaHD);
                if ($is_inserted) {
                    $_SESSION['success'] = "Tạo hợp đồng thành công";
                } else {
                    $_SESSION['error'] = "Tạo hợp đồng thất bại";
                }
                header("Location: index.php?controller=contract&action=index");
                exit();
            }
        }

        $data['employees'] = $employee_model->getAll();
        $data['content'] = "contract/update";
        $data['page_title'] = "Tạo hợp đồng mới";
        $this->render("layouts/main", $data);
    }

    public function delete()
    {
        $contract_model = new ContractModel();
        if (!isset($_GET['MaHD']) || !is_numeric($_GET['MaHD']) || $contract_model->getById($_GET['MaHD']) == NULL) {
            $_SESSION['error'] = "Id không hợp lệ";
            header("Location: index.php?controller=contract&action=index");
            exit();
        }

        $MaHD = $_GET['MaHD'];
        $is_deleted = $contract_model->delete($MaHD);
        if ($is_deleted) {
            $_SESSION['success'] = "Xóa hợp đồng thành công";
        } else {
            $_SESSION['error'] = "Xóa hợp đồng thất bại";
        }
        header("Location: index.php?controller=contract&action=index");
        exit();
    }
}
