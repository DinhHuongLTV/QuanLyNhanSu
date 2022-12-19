<?php
session_start();
require_once "app/controllers/Controller.php";
require_once "app/models/EmployeeModel.php";
require_once "app/models/DepartmentModel.php";
require_once "app/models/PostionModel.php";
require_once "app/models/LevelModel.php";
require_once "app/models/SalaryModel.php";
class EmployeeController extends Controller
{
    public function index()
    {
        $employee_model = new EmployeeModel();

        $data['data'] = $employee_model->getAll();
        $data['page_title'] = "Danh sách nhân viên";
        $data['content'] = 'employee/index';
        $this->render('layouts/main', $data);
    }

    public function create()
    {
        $employee_model = new EmployeeModel();
        $department_model = new DepartmentModel();
        $position_model = new PositionModel();
        $level_model = new LevelModel();
        $salary_model = new SalaryModel();

        // echo "<pre>";
        // print_r($_POST);
        // echo "</pre>";
        if (isset($_POST['submit'])) {
            $fullname = $_POST['fullname'];
            $phone = $_POST['phone'];
            $gender = $_POST['gender'];
            $department = $_POST['department'];
            $position = $_POST['position'];
            $que_quan = $_POST['que_quan'];
            $level = $_POST['level'];
            $avatar = $_FILES['avatar'];
            $salary = $_POST['salary'];
            $date_of_birth = $_POST['date_of_birth'];
            if (empty($fullname) || empty($phone) || empty($date_of_birth) || empty($avatar)) {
                $_SESSION['error'] = "Không để trống các trường dấu *";
            } else if ($avatar['error'] == 0) {
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
                $filename = "placeholder.png";
                if ($avatar['error'] == 0) {
                    $dir_upload = "assets/uploads";
                    if (!file_exists($dir_upload)) {
                        mkdir($dir_upload);
                    }
                    $filename = time() . "-nhanvien-" . $avatar['name'];
                    move_uploaded_file($avatar['tmp_name'], $dir_upload . '/' . $filename);
                }
                $employee_model->__ho_ten = $fullname;
                $employee_model->__sdt = $phone;
                $employee_model->__gioi_tinh = $gender;
                $employee_model->__avatar = $filename;
                $employee_model->__ngay_sinh = $date_of_birth;
                $employee_model->__que = $que_quan;
                $employee_model->__ma_cv = $position;
                $employee_model->__ma_pb = $department;
                $employee_model->__ma_tdhv = $level;
                $employee_model->__bac_luong = $salary;
                $is_inserted = $employee_model->create();
                if ($is_inserted) {
                    $_SESSION['success'] = "Thêm nhân viên thành công";
                } else {
                    $_SESSION['error'] = "Thêm nhân viên thất bại";
                }
                header("Location: index.php?controller=employee&action=index");
                exit();
            }
        }

        $data['data']['departments'] = $department_model->getAll();
        $data['data']['positions'] = $position_model->getAll();
        $data['data']['levels'] = $level_model->getAll();
        $data['data']['salaries'] = $salary_model->getAll();
        $data['content'] = "employee/create";
        $data['page_title'] = "Thêm nhân viên";
        $this->render("layouts/main", $data);
    }

    public function update()
    {
        $employee_model = new EmployeeModel();
        $department_model = new DepartmentModel();
        $position_model = new PositionModel();
        $level_model = new LevelModel();
        $salary_model = new SalaryModel();

        if (!isset($_GET['MaNV']) || !is_numeric($_GET['MaNV']) || $employee_model->getById($_GET['MaNV']) == NULL) {
            $_SESSION['error'] = "Id không hợp lệ";
            header("Location: index.php?controller=employee&action=index");
            exit();
        }

        $MaNV = $_GET['MaNV'];
        $data['data'] = $employee_model->getById($MaNV);
        if (isset($_POST['submit'])) {
            $fullname = $_POST['fullname'];
            $phone = $_POST['phone'];
            $gender = $_POST['gender'];
            $department = $_POST['department'];
            $position = $_POST['position'];
            $que_quan = $_POST['que_quan'];
            $level = $_POST['level'];
            $avatar = $_FILES['avatar'];
            $salary = $_POST['salary'];
            $date_of_birth = $_POST['date_of_birth'];
            if (empty($fullname) || empty($phone) || empty($date_of_birth) || empty($avatar)) {
                $_SESSION['error'] = "Không để trống các trường dấu *";
            } else if ($avatar['error'] == 0) {
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
                $filename = $data['employee']['avatar'];
                if ($avatar['error'] == 0) {
                    $dir_upload = "assets/uploads";
                    if (!file_exists($dir_upload)) {
                        mkdir($dir_upload);
                    }
                    $filename = time() . "-nhanvien-" . $avatar['name'];
                    move_uploaded_file($avatar['tmp_name'], $dir_upload . '/' . $filename);
                }
                $employee_model->__ho_ten = $fullname;
                $employee_model->__sdt = $phone;
                $employee_model->__gioi_tinh = $gender;
                $employee_model->__avatar = $filename;
                $employee_model->__ngay_sinh = $date_of_birth;
                $employee_model->__que = $que_quan;
                $employee_model->__ma_cv = $position;
                $employee_model->__ma_pb = $department;
                $employee_model->__ma_tdhv = $level;
                $employee_model->__bac_luong = $salary;
                $is_inserted = $employee_model->update($MaNV);
                if ($is_inserted) {
                    $_SESSION['success'] = "Cập nhật nhân viên thành công";
                } else {
                    $_SESSION['error'] = "Cập nhật nhân viên thất bại";
                }
                header("Location: index.php?controller=employee&action=index");
                exit();
            }
        }
        $data['data']['departments'] = $department_model->getAll();
        $data['data']['positions'] = $position_model->getAll();
        $data['data']['levels'] = $level_model->getAll();
        $data['data']['salaries'] = $salary_model->getAll();
        $data['content'] = "employee/update";
        $data['page_title'] = "Cập nhật thông tin nhân viên";
        $this->render("layouts/main", $data);
    }

    public function delete()
    {
        $employee_model = new EmployeeModel();
        if (!isset($_GET['MaNV']) || !is_numeric($_GET['MaNV']) || $employee_model->getById($_GET['MaNV']) == NULL) {
            $_SESSION['error'] = "Id không hợp lệ";
            header("Location: index.php?controller=employee&action=index");
            exit();
        }

        $MaNV = $_GET['MaNV'];
        $is_deleted = $employee_model->delete($MaNV);
        if ($is_deleted) {
            $_SESSION['success'] = "Xóa nhân viên thành công";
        } else {
            $_SESSION['error'] = "Xóa nhân viên thất bại";
        }
        header("Location: index.php?controller=employee&action=index");
        exit();
    }

    public function detail()
    {
        $employee_model = new EmployeeModel();
        $department_model = new DepartmentModel();
        $position_model = new PositionModel();
        $level_model = new LevelModel();
        $salary_model = new SalaryModel();
        if (!isset($_GET['MaNV']) || !is_numeric($_GET['MaNV']) || $employee_model->getById($_GET['MaNV']) == NULL) {
            $_SESSION['error'] = "Id không hợp lệ";
            header("Location: index.php?controller=employee&action=index");
            exit();
        }

        $MaNV = $_GET['MaNV'];
        $data['data']['employee'] = $employee_model->getById($MaNV);
        $data['data']['departments'] = $department_model->getAll();
        $data['data']['positions'] = $position_model->getAll();
        $data['data']['levels'] = $level_model->getAll();
        $data['data']['salaries'] = $salary_model->getAll();
        $data['content'] = "employee/detail";
        $this->render("layouts/main", $data);
    }
}
