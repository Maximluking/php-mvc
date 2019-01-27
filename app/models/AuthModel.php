<?php

namespace app\models;

use PDO;

class AuthModel extends Model
{
    public function checkUser()
    {
        $login = strip_tags($_POST['login']);
        $password = md5(strip_tags($_POST['password']));

        $sql = "SELECT * FROM users WHERE login = :login AND password = :password AND role_id = 1";

        $statement = $this->db->prepare($sql);
        $statement->bindValue(":login", $login, PDO::PARAM_STR);
        $statement->bindValue(":password", $password, PDO::PARAM_STR);
        $statement->execute();

        $res = $statement->fetch(PDO::FETCH_ASSOC);

        if(!empty($res)) {
            $_SESSION['user'] = strip_tags($_POST['login']);
            $_SESSION['userId'] = $res['id'];
            $_SESSION['role_id'] = $res['role_id'];
            header("Location: /");
        } else {
            return false;
        }
    }
}