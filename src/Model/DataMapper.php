<?php

namespace Src\Model;

/**
 * Class DataMapper
 * @package Src\Model
 *
 * @property \PDO $pdo
 */
abstract class DataMapper
{
    protected $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }
}