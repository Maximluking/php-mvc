<?php

namespace app\controllers;

use app\models\TaskModel;
use app\views\View;

class TasksController extends Controller
{
    private $pageTpl = VIEW_PATH . 'tasks/tasksIndex.php';
    private $pageTplCreateEdit = VIEW_PATH . 'tasks/tasksCreateEdit.tpl.php';

    public function __construct()
    {
        $this->model = new TaskModel();
        $this->view = new View();
    }

    public function actionIndex($column = '', $sort = '', $page = 0)
    {
        if (isset($_GET['column']) && !empty($_GET['column'])) $column = strip_tags(trim($_GET['column']));
        if (isset($_GET['sort']) && !empty($_GET['sort']) && (strip_tags(trim($_GET['sort'])) === 'ASC' || strip_tags(trim($_GET['sort'])) === 'DESC')) $sort = $_GET['sort'];
        if (isset($_GET['page']) && !empty($_GET['page'])) $page = strip_tags(trim($_GET['page']));
        $this->pageData['title'] = "Tasks";
        $this->pageData['data'] = $this->model->getTasks($column, $sort, $page);
        if ($_SESSION['role_id']) $this->pageData['permission'] = $_SESSION['role_id'];
        $this->view->render($this->pageTpl, $this->pageData);
    }

    public function actionCreate()
    {
        if ($_SESSION['role_id']) $this->pageData['permission'] = $_SESSION['role_id'];
        $this->pageData['title'] = "Task";
        $this->view->render($this->pageTplCreateEdit, $this->pageData);
    }

    public function actionEdit()
    {
        if (!$_SESSION['user']) {
            header("Location: /");
        }

        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $id = $_GET['id'];
            $this->pageData['task'] = $this->model->getTaskById($id);
            if ($_SESSION['role_id']) $this->pageData['permission'] = $_SESSION['role_id'];
            $this->view->render($this->pageTplCreateEdit, $this->pageData);
        }
    }


    public function actionDelete()
    {
        if (!$_SESSION['user']) {
            header("Location: /");
        }

        if (!empty($_GET) && !empty($_GET['id'])) {
            $id = strip_tags(trim($_GET['id']));
            $this->model->deleteTask($id);
            header("Location: /");
        }
    }

    public function actionSave()
    {
        if (!empty($_POST)) {
            if (isset($_POST['id'])&&!empty($_POST['id'])) {
                $id = strip_tags(trim($_POST['id']));
            } else $id = 0;

            $name = strip_tags(trim($_POST['name']));
            $email = strip_tags(trim($_POST['email']));
            $content = strip_tags(trim($_POST['content']));
            $status = strip_tags(trim($_POST['status']));
            $this->model->saveTask($name, $email, $content, $id, $status);
            header("Location: /");
        }
    }
}