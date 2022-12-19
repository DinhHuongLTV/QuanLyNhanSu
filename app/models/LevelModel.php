<?php
require_once "app/models/Model.php";
class LevelModel extends Model
{
    public $__ma_tdhv, $__ten_tdhv, $__cnganh;
    public function getAll($params = [])
    {
        $sql_search = " WHERE TRUE";
        if (isset($params['name']) && !empty($params['name'])) {
            $name = $params['name'];
            $sql_search = " WHERE TenTDHV LIKE %$name%";
        }
        $sql_select_all = "SELECT * FROM trinhdohocvan $sql_search";
        $obj_select_all = $this->__connection->prepare($sql_select_all);
        $obj_select_all->execute();
        return $obj_select_all->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($MaTDHV)
    {
        $sql_select_one = "SELECT * FROM trinhdohocvan WHERE MaTDHV = :MaTDHV";
        $obj_select_one = $this->__connection->prepare($sql_select_one);
        $data = [
            ':MaTDHV' => $MaTDHV
        ];
        $obj_select_one->execute($data);
        return $obj_select_one->fetch(PDO::FETCH_ASSOC);
    }

    public function create()
    {
        $sql_insert = "INSERT INTO trinhdohocvan (TenTDHV, ChuyenNganh) VALUES (:TenTDHV, :ChuyenNganh)";
        $obj_insert = $this->__connection->prepare($sql_insert);
        $data = [
            ':TenTDHV' => $this->__ten_tdhv,
            ':ChuyenNganh' => $this->__cnganh,
        ];
        return $obj_insert->execute($data);
    }

    public function update($MaTDHV)
    {
        $sql_update = "UPDATE trinhdohocvan set TenTDHV = :TenTDHV, ChuyenNganh = :ChuyenNganh WHERE MaTDHV = :MaTDHV";
        $obj_update = $this->__connection->prepare($sql_update);
        $data = [
            ':TenTDHV' => $this->__ten_tdhv,
            ':ChuyenNganh' => $this->__cnganh,
            ':MaTDHV' => $MaTDHV,
        ];
        return $obj_update->execute($data);
    }

    public function delete($MaTDHV)
    {
        $sql_delete = "DELETE FROM trinhdohocvan WHERE MaTDHV = :MaTDHV";
        $obj_delete = $this->__connection->prepare($sql_delete);
        $data = [
            ':MaTDHV' => $MaTDHV
        ];
        return $obj_delete->execute($data);
    }
}
