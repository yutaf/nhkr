<?php

namespace Src\Model;

class PDOManager
{
    private static $pdo = array();

    public static function getPDO($env=null) {
//        static $pdo = array();

        if (! isset(self::$pdo[$env])) {
            if ($env) {
                $conf = require "db.{$env}.conf.php";
            } else {
                $conf = require 'db.conf.php';
            }
            self::$pdo[$env] = new \PDO(
                $conf['dsn'],
                $conf['user'],
                $conf['pass'],
                $conf['options'],
                array(
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_CLASS,
                )
            );
            //SQLiteで外部キー制約を有効にする
//            $pdo[$env]->query('PRAGMA foreign_keys = ON');
        }

        return self::$pdo[$env];
    }
}