<?php
require_once "app/models/Model.php";
class PositionModel extends Model
{
    public $__ma_cv, $__ten_cv;
    public function getAll($params = [])
    {
        $sql_search = " WHERE TRUE";
        if (isset($params['name']) && !empty($params['name'])) {
            $name = $params['name'];
            $sql_search = " WHERE TenCV LIKE %$name%";
        }
        $sql_select_all = "SELECT * FROM chucvu $sql_search";
        $obj_select_all = $this->__connection->prepare($sql_select_all);
        $obj_select_all->execute();
        return $obj_select_all->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($MaCV)
    {
        $sql_select_one = "SELECT * FROM chucvu WHERE MaCV = :MaCV";
        $obj_select_one = $this->__connection->prepare($sql_select_one);
        $data = [
            ':MaCV' => $MaCV
        ];
        $obj_select_one->execute($data);
        return $obj_select_one->fetch(PDO::FETCH_ASSOC);
    }

    public function create()
    {
        $sql_insert = "INSERT INTO chucvu (TenCV) VALUES (:TenCV)";
        $obj_insert = $this->__connection->prepare($sql_insert);
        $data = [
            ':TenCV' => $this->__ten_cv,
        ];
        return $obj_insert->execute($data);
    }

    public function update($MaCV)
    {
        $sql_update = "UPDATE chucvu set TenCV = :TenCV WHERE MaCV = :MaCV";
        $obj_update = $this->__connection->prepare($sql_update);
        $data = [
            ':TenCV' => $this->__ten_cv,
            ':MaCV' => $MaCV,
        ];
        return $obj_update->execute($data);
    }

    public function delete($MaCV)
    {
        $sql_delete = "DELETE FROM chucvu WHERE MaCV = :MaCV";
        $obj_delete = $this->__connection->prepare($sql_delete);
        $data = [
            ':MaCV' => $MaCV
        ];
        return $obj_delete->execute($data);
    }
}
