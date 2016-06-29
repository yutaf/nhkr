<?php

namespace Src\Model;

class UserMapper extends DataMapper
{
    private $table = 'users';

    public function insert($data)
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO {$this->table} (email, password, area, locale, created, modified)
            VALUES (:email, :password, :area, :locale, :created, :modified)
        ");
        $stmt->bindParam(':email',      $email,     \PDO::PARAM_STR);
        $stmt->bindParam(':password',   $password,  \PDO::PARAM_STR);
        $stmt->bindParam(':area',       $area,      \PDO::PARAM_INT);
        $stmt->bindParam(':locale',     $locale,    \PDO::PARAM_INT);
        $stmt->bindParam(':created',    $created,   \PDO::PARAM_STR);
        $stmt->bindParam(':modified',   $modified,  \PDO::PARAM_STR);

        if (! is_array($data)) {
            $data = array($data);
        }
        foreach ($data as $row) {
            if (! $row instanceof User) {
                throw new \InvalidArgumentException;
            }

            //TODO Validation


            $email      = $row->email;
            $password   = $row->password;
            $area       = $row->area;
            $locale     = $row->locale;
            $created    = $row->created->format(\DateTime::ISO8601);
            $modified   = $row->modified->format(\DateTime::ISO8601);

            $stmt->execute();

            //autoincrementな主キーをオブジェクト側へ反映
            $row->id = $this->pdo->lastInsertId();
        }
    }
}