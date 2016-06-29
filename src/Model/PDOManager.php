<?php

namespace Src\Model;

class PDOManager
{
    private static $pdo = array();

    /**
     * @param null $env
     * @return \PDO
     */
    public static function getPDO($env=null) {
//        static $pdo = array();

        if (! isset(self::$pdo[$env])) {
            if ($env) {
                $conf = require "db.{$env}.conf.php";
            } else {
                $conf = require 'db.conf.php';
            }

            $options = array(
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_CLASS,
            );
            if(is_array($conf['options']) && count($conf['options'])>0) {
                $options = array_merge($options, $conf['options']);
            }
            self::$pdo[$env] = new \PDO(
                $conf['dsn'],
                $conf['user'],
                $conf['pass'],
                $options
            );
        }

        return self::$pdo[$env];
    }
}