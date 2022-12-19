<?php
require_once "app/models/Model.php";
class ContractModel extends Model
{
    public $__ma_hd, $__ma_nv, $__thoi_han, $__tu_ngay, $__den_ngay;
    public function getAll()
    {
        $sql_search = " WHERE TRUE";
        $sql_select_all = "SELECT * FROM hopdonglaodong $sql_search";
        $obj_select_all = $this->__connection->prepare($sql_select_all);
        $obj_select_all->execute();
        return $obj_select_all->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($MaHD)
    {
        $sql_select_one = "SELECT * FROM hopdonglaodong WHERE MaHD = :MaHD";
        $obj_select_one = $this->__connection->prepare($sql_select_one);
        $data = [
            ':MaHD' => $MaHD
        ];
        $obj_select_one->execute($data);
        return $obj_select_one->fetch(PDO::FETCH_ASSOC);
    }

    public function create()
    {
        $sql_insert = "INSERT INTO hopdonglaodong (MaNV, ThoiHan, TuNgay, DenNgay) VALUES (:MaNV, :ThoiHan, :TuNgay, :DenNgay)";
        $obj_insert = $this->__connection->prepare($sql_insert);
        $data = [
            ':MaNV' => $this->__ma_nv,
            ':ThoiHan' => $this->__thoi_han,
            ':TuNgay' => $this->__tu_ngay,
            ':DenNgay' => $this->__den_ngay,
        ];
        return $obj_insert->execute($data);
    }

    public function update($MaHD)
    {
        $sql_update = "UPDATE hopdonlaodong set MaNV = :MaNV, ThoiHan = :ThoiHan, TuNgay = :TuNgay, DenNgay = :DenNgay WHERE MaHD = :MaHD";
        $obj_update = $this->__connection->prepare($sql_update);
        $data = [
            ':MaNV' => $this->__ma_nv,
            ':ThoiHan' => $this->__thoi_han,
            ':TuNgay' => $this->__tu_ngay,
            ':DenNgay' => $this->__den_ngay,
            ':MaHD' => $MaHD,
        ];
        return $obj_update->execute($data);
    }

    public function delete($MaHD)
    {
        $sql_delete = "DELETE FROM hopdonglaodong WHERE MaHD = :MaHD";
        $obj_delete = $this->__connection->prepare($sql_delete);
        $data = [
            ':MaHD' => $MaHD
        ];
        return $obj_delete->execute($data);
    }
}
