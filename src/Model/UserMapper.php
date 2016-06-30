<?php

namespace Src\Model;

use Symfony\Component\Validator\Validation;

class UserMapper extends DataMapper
{
    public function insert($data)
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO users (email, password, area, locale, created, modified)
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

            // Validation
            $validator = Validation::createValidatorBuilder()
                ->addMethodMapping('loadValidatorMetadata')
                ->getValidator()
                ;
            $violations = $validator->validate($row);
            if(count($violations)>0) {
                $errors = [];
                foreach($violations as $violation) {
                    $errors[] = "`{$violation->getPropertyPath()}` {$violation->getMessage()}";
                }
                $error = implode("\n", $errors);
                throw new \InvalidArgumentException($error);
            }

            $email      = $row->email;
            $password   = $row->password;
            $area       = $row->area;
            $locale     = $row->locale;
            $created    = $row->created->format('Y-m-d H:i:s');
            $modified   = $row->modified->format('Y-m-d H:i:s');

            $stmt->execute();

            //autoincrementな主キーをオブジェクト側へ反映
            $row->id = $this->pdo->lastInsertId();
        }
    }
}