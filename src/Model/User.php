<?php

namespace Src\Model;

use Symfony\Component\Validator\Constraints;
use Symfony\Component\Validator\Mapping\ClassMetadata;

/**
 * Class User
 * @package Src\Model
 *
 * @property Integer    $id
 * @property String     $email
 * @property String     $password
 * @property Integer    $area
 * @property Integer    $locale
 * @property \DateTime  $created
 * @property \DateTime  $modified
 */
class User extends DataModel
{
    protected $id;
    protected $email;
    protected $password;
    protected $area;
    protected $locale;
    protected $created;
    protected $modified;

    protected static $schema = array(
        'id'        => self::INTEGER,
        'email'     => self::STRING,
        'password'  => self::STRING,
        'area'      => self::INTEGER,
        'locale'    => self::INTEGER,
        'created'   => self::DATETIME,
        'modified'  => self::DATETIME,
    );

    function isValid()
    {
        // email field is required, max 200 characters
        $val = $this->email;
        if (empty($val) || !mb_check_encoding($val) || mb_strlen($val) > 200) {
            return false;
        }
        // password field is required, max 200 characters
        $val = $this->password;
        if (empty($val) || !mb_check_encoding($val) || mb_strlen($val) > 200) {
            return false;
        }
        // area field is required, max 5 characters
        $val = $this->area;
        if (empty($val) || strlen($val) > 5) {
            return false;
        }
        // locale field is required, max 3 characters
        $val = $this->locale;
        if (empty($val) || strlen($val) > 3) {
            return false;
        }
        // created field is required
        $val = $this->created;
        if (empty($val)) {
            return false;
        }
        // modified field is required
        $val = $this->modified;
        if (empty($val)) {
            return false;
        }

        return true;
    }
}