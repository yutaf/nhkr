<?php

return [
    'dsn' => "mysql:dbname={$_ENV['PHINX_DBNAME']};host={$_ENV['PHINX_DBHOST']}",
    'user' => $_ENV['PHINX_DBUSER'],
    'pass' => $_ENV['PHINX_DBPASS'],
    'options' => [
        \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    ],
];