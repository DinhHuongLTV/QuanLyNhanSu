<?php
require_once "app/models/Model.php";
class DepartmentModel extends Model
{
    public $__ma_pb, $__ten_pb, $__dia_chi, $__sdt;
    public function getAll($params = [])
    {
        $sql_search = " WHERE TRUE";
        if (isset($params['name']) && !empty($params['name'])) {
            $name = $params['name'];
            $sql_search = " WHERE TenPB LIKE %$name%";
        }
        $sql_select_all = "SELECT * FROM phongban $sql_search";
        $obj_select_all = $this->__connection->prepare($sql_select_all);
        $obj_select_all->execute();
        return $obj_select_all->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($MaPB)
    {
        $sql_select_one = "SELECT * FROM phongban WHERE MaPB = :MaPB";
        $obj_select_one = $this->__connection->prepare($sql_select_one);
        $data = [
            ':MaPB' => $MaPB
        ];
        $obj_select_one->execute($data);
        return $obj_select_one->fetch(PDO::FETCH_ASSOC);
    }

    public function create()
    {
        $sql_insert = "INSERT INTO phongban (TenPB, DiaChi, SDTPB) VALUES (:TenPB, :DiaChi, :SDTPB)";
        $obj_insert = $this->__connection->prepare($sql_insert);
        $data = [
            ':TenPB' => $this->__ten_pb,
            ':DiaChi' => $this->__dia_chi,
            ':SDTPB' => $this->__sdt,
        ];
        return $obj_insert->execute($data);
    }

    public function update($MaPB)
    {
        $sql_update = "UPDATE phongban set TenPB = :TenPB, DiaChi = :DiaChi, SDTPB = :SDTPB WHERE MaPB = :MaPB";
        $obj_update = $this->__connection->prepare($sql_update);
        $data = [
            ':TenPB' => $this->__ten_pb,
            ':DiaChi' => $this->__dia_chi,
            ':SDTPB' => $this->__sdt,
            ':MaPB' => $MaPB,
        ];
        return $obj_update->execute($data);
    }

    public function delete($MaPB)
    {
        $sql_delete = "DELETE FROM phongban WHERE MaPB = :MaPB";
        $obj_delete = $this->__connection->prepare($sql_delete);
        $data = [
            ':MaPB' => $MaPB
        ];
        return $obj_delete->execute($data);
    }
}
