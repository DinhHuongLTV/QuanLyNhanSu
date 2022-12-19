<?php
require_once "app/models/Model.php";
class SalaryModel extends Model
{
    public $__bac_luong, $__luong_cb, $__hsl, $__phu_cap;
    public function getAll()
    {
        $sql_search = " WHERE TRUE";
        $sql_select_all = "SELECT * FROM luong $sql_search";
        $obj_select_all = $this->__connection->prepare($sql_select_all);
        $obj_select_all->execute();
        return $obj_select_all->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($BacLuong)
    {
        $sql_select_one = "SELECT * FROM luong WHERE BacLuong = :BacLuong";
        $obj_select_one = $this->__connection->prepare($sql_select_one);
        $data = [
            ':BacLuong' => $BacLuong
        ];
        $obj_select_one->execute($data);
        return $obj_select_one->fetch(PDO::FETCH_ASSOC);
    }

    public function create()
    {
        $sql_insert = "INSERT INTO luong (BacLuong, LuongCB, PhuCap, HSL) VALUES (:BacLuong, :LuongCB, :PhuCap, :HSL)";
        $obj_insert = $this->__connection->prepare($sql_insert);
        $data = [
            ':BacLuong' => $this->__bac_luong,
            ':LuongCB' => $this->__luong_cb,
            ':PhuCap' => $this->__phu_cap,
            ':HSL' => $this->__hsl,
        ];
        return $obj_insert->execute($data);
    }

    public function update($BacLuong)
    {
        $sql_update = "UPDATE luong set LuongCB = :LuongCB, PhuCap = :PhuCap, HSL = :HSL WHERE BacLuong = :BacLuong";
        $obj_update = $this->__connection->prepare($sql_update);
        $data = [
            ':LuongCB' => $this->__luong_cb,
            ':PhuCap' => $this->__phu_cap,
            ':HSL' => $this->__hsl,
            ':BacLuong' => $BacLuong,
        ];
        return $obj_update->execute($data);
    }

    public function delete($BacLuong)
    {
        $sql_delete = "DELETE FROM luong WHERE BacLuong = :BacLuong";
        $obj_delete = $this->__connection->prepare($sql_delete);
        $data = [
            ':BacLuong' => $BacLuong
        ];
        return $obj_delete->execute($data);
    }
}
