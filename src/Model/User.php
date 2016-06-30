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

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraints('email', [
            new Constraints\NotBlank(),
            new Constraints\Email(),
        ]);
    }
}