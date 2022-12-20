<?php
require_once "app/models/Model.php";
class EmployeeModel extends Model
{
    public $__ma_nv, $__avatar, $__ho_ten, $__ngay_sinh, $__que, $__gioi_tinh, $__sdt, $__ma_pb, $__ma_cv, $__ma_tdhv, $__bac_luong;
    public function getAll($params = [])
    {
        $sql_search = " WHERE TRUE";
        if (isset($params['name']) && !empty($params['name'])) {
            $name = $params['name'];
            $sql_search = " WHERE HoTen LIKE %$name%";
        }
        $sql_select_all = "SELECT * FROM nhanvien $sql_search";
        $obj_select_all = $this->__connection->prepare($sql_select_all);
        $obj_select_all->execute();
        return $obj_select_all->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($MaNV)
    {
        $sql_select_one = "SELECT * FROM nhanvien WHERE MaNV = :MaNV";
        $obj_select_one = $this->__connection->prepare($sql_select_one);
        $data = [
            ':MaNV' => $MaNV
        ];
        $obj_select_one->execute($data);
        return $obj_select_one->fetch(PDO::FETCH_ASSOC);
    }

    public function create()
    {
        $sql_insert = "INSERT INTO nhanvien (HoTen, NgaySinh, QueQuan, GioiTinh, SDT, MaPB, MaCV, MaTDHV, BacLuong, avatar) 
        VALUES (:HoTen, :NgaySinh, :QueQuan, :GioiTinh, :SDT, :MaPB, :MaCV, :MaTDHV, :BacLuong, :avatar)";
        $obj_insert = $this->__connection->prepare($sql_insert);
        $data = [
            ':HoTen' => $this->__ho_ten,
            ':NgaySinh' => $this->__ngay_sinh,
            ':SDT' => $this->__sdt,
            ':QueQuan' => $this->__que,
            ':GioiTinh' => $this->__gioi_tinh,
            ':MaPB' => $this->__ma_pb,
            ':MaCV' => $this->__ma_cv,
            ':MaTDHV' => $this->__ma_tdhv,
            ':BacLuong' => $this->__bac_luong,
            ':avatar' => $this->__avatar,
        ];
        return $obj_insert->execute($data);
    }

    public function update($MaNV)
    {
        $sql_update = "UPDATE nhanvien set HoTen = :HoTen, NgaySinh = :NgaySinh, QueQuan = :QueQuan, GioiTinh = :GioiTinh, SDT = :SDT, MaPB = :MaPB, MaCV = :MaCV, MaTDHV = :MaTDHV, BacLuong = :BacLuong, avatar = :avatar WHERE MaNV = :MaNV";
        $obj_update = $this->__connection->prepare($sql_update);
        $data = [
            ':HoTen' => $this->__ho_ten,
            ':NgaySinh' => $this->__ngay_sinh,
            ':SDT' => $this->__sdt,
            ':QueQuan' => $this->__que,
            ':GioiTinh' => $this->__gioi_tinh,
            ':MaPB' => $this->__ma_pb,
            ':MaCV' => $this->__ma_cv,
            ':MaTDHV' => $this->__ma_tdhv,
            ':BacLuong' => $this->__bac_luong,
            ':avatar' => $this->__avatar,
            ':MaNV' => $MaNV
        ];
        return $obj_update->execute($data);
    }

    public function delete($MaNV)
    {
        $sql_delete = "DELETE FROM nhanvien WHERE MaNV = :MaNV";
        $obj_delete = $this->__connection->prepare($sql_delete);
        $data = [
            ':MaNV' => $MaNV
        ];
        return $obj_delete->execute($data);
    }
}
