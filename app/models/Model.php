<?php

namespace app\models;

use app\core\DB;

class Model
{
    protected $db = null;

    public function __construct() {
        $this->db = DB::connToDB();
    }
}