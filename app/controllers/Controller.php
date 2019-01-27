<?php

namespace app\controllers;

use app\models\Model;
use app\views\View;

class Controller
{
    public $model;
    public $view;
    protected $pageData = array();

    public function __construct() {
        $this->view = new View();
        $this->model = new Model();
    }
}