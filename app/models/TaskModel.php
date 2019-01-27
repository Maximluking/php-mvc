<?php

namespace app\models;

use PDO;

class TaskModel extends Model
{
    const LIMIT_PAGINATION = 3;

    public function getTasks($column = '', $sort = '', $page = 0)
    {
        $sql = "SELECT * FROM tasks";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $totalRows = $stmt->rowCount();
        $totalPages = ceil($totalRows/self::LIMIT_PAGINATION);

        if (empty($page)) $page = 1;
        $start = ($page - 1) * self::LIMIT_PAGINATION;

        $sql = "SELECT * FROM tasks" . ((!empty($column) && !empty($sort)) ? " ORDER BY $column $sort " : " ") . "LIMIT :start, " . ":limit";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":start", $start, PDO::PARAM_INT);
        $stmt->bindValue(":limit", self::LIMIT_PAGINATION, PDO::PARAM_INT);
        $stmt->execute();

        $result = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result['tasksList'][$row['id']] = $row;
        }
        $result['totalPages'] = $totalPages;
        $result['currentPage'] = $page;
        if (!empty($sort)) $result['currentSort'] = $sort;
        return $result;
    }

    public function getTaskById($id)
    {
        $sql = "SELECT tasks.id, tasks.name, tasks.email, tasks.content, tasks.status FROM tasks WHERE tasks.id=:id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }

    public function saveTask($name, $email, $content, $id = 0, $status = 0)
    {
        if (empty($id)) {
            $sql = "INSERT INTO tasks(name, email, content, status)
                VALUES (:name, :email, :content, :status)
                ";
        } else {
            $sql = "UPDATE tasks SET name=:name, email=:email, content=:content, status=:status
                WHERE tasks.id=:id
                ";
        }

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":name", $name, PDO::PARAM_STR);
        $stmt->bindValue(":email", $email, PDO::PARAM_STR);
        $stmt->bindValue(":content", $content, PDO::PARAM_STR);
        $stmt->bindValue(":status", $status, PDO::PARAM_INT);
        if (!empty($id)) $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        if (empty($stmt->errorInfo())) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteTask($id)
    {
        $sql = "DELETE FROM tasks WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        if (empty($stmt->errorInfo())) {
            return true;
        } else {
            return false;
        }
    }
}