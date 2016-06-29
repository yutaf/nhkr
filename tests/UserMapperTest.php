<?php

use PHPUnit\Framework\TestCase;

class UserMapperTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var \PDO
     */
    private static $pdo;

    public static function setUpBeforeClass()
    {
        self::$pdo = Src\Model\PDOManager::getPDO();
    }

    public function testInsert()
    {
        $userMapper = new \Src\Model\UserMapper(self::$pdo);

        $user = new \Src\Model\User();
        $user->email = 'yutafuji2008@gmail.com';
        $user->password = '123abc';
        $user->area = 100;
        $user->locale = 2;
        $user->created = new DateTime();
        $user->modified = new DateTime();

        self::$pdo->beginTransaction();
        $userMapper->insert($user);
        self::$pdo->rollBack();

        $this->assertArrayHasKey('id', $user->toArray());
    }
}