<?php

namespace app\controllers;

use app\models\AuthModel;
use app\views\View;

class AuthController extends Controller
{
    private $pageTpl = VIEW_PATH . 'auth.tpl.php';

    public function __construct()
    {
        $this->model = new AuthModel();
        $this->view = new View();
    }

    public function actionLogin()
    {
        $this->pageData['title'] = "Authorization";
        if(!empty($_POST)) {
            if(!$this->login()) {
                $this->pageData['loginError'] = "Incorrect login or password";
            }
        }
        $this->view->render($this->pageTpl, $this->pageData);
    }

    public function login()
    {
        if(!$this->model->checkUser()) {
            return false;
        }
    }

    public function actionLogout()
    {
        session_destroy();
        header("Location: /");
    }
}