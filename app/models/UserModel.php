<?php
require_once "app/models/Model.php";
class UserModel extends Model
{
    public $__username, $__password, $__avatar;
    public function getAll()
    {
        $sql_search = " WHERE TRUE";
        $sql_select_all = "SELECT * FROM quantrivien $sql_search";
        $obj_select_all = $this->__connection->prepare($sql_select_all);
        $obj_select_all->execute();
        return $obj_select_all->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $sql_select_one = "SELECT * FROM quantrivien WHERE id = :id";
        $obj_select_one = $this->__connection->prepare($sql_select_one);
        $data = [
            ':id' => $id
        ];
        $obj_select_one->execute($data);
        return $obj_select_one->fetch(PDO::FETCH_ASSOC);
    }
    public function getByName($username)
    {
        $sql_select_one = "SELECT * FROM quantrivien WHERE username = :username";
        $obj_select_one = $this->__connection->prepare($sql_select_one);
        $data = [
            ':username' => $username
        ];
        $obj_select_one->execute($data);
        return $obj_select_one->fetch(PDO::FETCH_ASSOC);
    }

    public function create()
    {
        $sql_insert = "INSERT INTO quantrivien (username, password, avatar) VALUES (:username, :password, :avatar)";
        $obj_insert = $this->__connection->prepare($sql_insert);
        $data = [
            ':username' => $this->__username,
            ':password' => $this->__password,
            ':avatar' => $this->__avatar,
        ];
        return $obj_insert->execute($data);
    }

    public function update($id)
    {
        $sql_update = "UPDATE quantrivien set username = :username, password = :password, avatar = :avatar WHERE id = :id";
        $obj_update = $this->__connection->prepare($sql_update);
        $data = [
            ':username' => $this->__username,
            ':password' => $this->__password,
            ':avatar' => $this->__avatar,
            ':id' => $id,
        ];
        return $obj_update->execute($data);
    }

    public function delete($id)
    {
        $sql_delete = "DELETE FROM quantrivien WHERE id = :id";
        $obj_delete = $this->__connection->prepare($sql_delete);
        $data = [
            ':id' => $id
        ];
        return $obj_delete->execute($data);
    }
}
