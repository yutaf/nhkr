<?php

namespace Src\Model;

abstract class DataModel
{
    const BOOLEAN = 'boolean';
    const INTEGER = 'integer';
    const DOUBLE  = 'double';
    const FLOAT   = 'double';
    const STRING  = 'string';
    const DATETIME = 'dateTime';

    protected $data = array();
    protected static $schema = array();

    abstract function isValid();

    public function __get($prop) {
        if (isset($this->data[$prop])) {
            return $this->data[$prop];
        } elseif (isset(static::$schema[$prop])) {
            return null;
        } else {
            throw new \InvalidArgumentException;
        }
    }

    public function __isset($prop) {
        return isset($this->data[$prop]);
    }

    public function __set($prop, $val) {
        if (!isset(static::$schema[$prop])) {
            throw new \InvalidArgumentException("{$prop} is invalid");
        }

        $schema = static::$schema[$prop];
        $type = gettype($val);

        if ($schema === self::DATETIME) {
            if ($val instanceof \DateTime) {
                $this->data[$prop] = $val;
            } else {
                $this->data[$prop] = new \DateTime($val);
            }
            return true;
        }

        if ($type === $schema) {
            $this->data[$prop] = $val;
            return true;
        }

        switch ($schema) {
            case self::BOOLEAN:
                return $this->data[$prop] = (bool)$val;
            case self::INTEGER:
                return $this->data[$prop] = intval($val);
            case self::DOUBLE:
                return $this->data[$prop] = floatval($val);
            case self::STRING:
            default:
                return $this->data[$prop] = strval($val);
        }
    }
}