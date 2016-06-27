<?php

namespace Src\Model;

abstract class DataMapper
{
    protected $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->_pdo = $pdo;
    }
}