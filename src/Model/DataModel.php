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

    protected static $schema = array();

    public function __isset($prop) {
        return isset($this->$prop);
    }

    public function __get($prop) {
        if (isset($this->$prop)) {
            return $this->$prop;
        } elseif (isset(static::$schema[$prop])) {
            return null;
        } else {
            throw new \InvalidArgumentException;
        }
    }

    public function __set($prop, $val) {
        if (!isset(static::$schema[$prop])) {
            throw new \InvalidArgumentException("{$prop} is invalid");
        }

        $schema = static::$schema[$prop];
        $type = gettype($val);

        if ($schema === self::DATETIME) {
            if ($val instanceof \DateTime) {
                $this->$prop = $val;
            } else {
                $this->$prop = new \DateTime($val);
            }
            return true;
        }

        if ($type === $schema) {
            $this->$prop = $val;
            return true;
        }

        switch ($schema) {
            case self::BOOLEAN:
                return $this->$prop = (bool)$val;
            case self::INTEGER:
                return $this->$prop = intval($val);
            case self::DOUBLE:
                return $this->$prop = floatval($val);
            case self::STRING:
            default:
                return $this->$prop = strval($val);
        }
    }

    function toArray() {
        return $this->data;
    }
}