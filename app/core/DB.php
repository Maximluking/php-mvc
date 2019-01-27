<?php

namespace app\core;

use PDO;
use PDOException;

class DB
{

    private static $dbConf = [];
    public static $instance = null;

    public static function connToDB()
    {
        self::$dbConf = require_once CONF_PATH . 'db.php';

        $user = self::$dbConf['user'];
        $pass = self::$dbConf['password'];
        $host = self::$dbConf['host'];
        $db = self::$dbConf['name'];
        $charset = self::$dbConf['charset'];

        if (!self::$instance) {
            try {
                self::$instance = new PDO("mysql:dbname=$db;host=$host", $user, $pass);
                self::$instance->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
                self::$instance->exec("SET NAMES $charset");
            } catch (PDOException $e) {
                die($e);
            }
        }
        return self::$instance;
    }
}
