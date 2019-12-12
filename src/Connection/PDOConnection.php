<?php

declare(strict_types=1);

namespace App\Connection;

use PDO;

class PDOConnection
{
    public function pdo()
    {
        $localhost = "localhost";
        $user = "root";
        $pass = "";
        $database = "tcc";

        $conexao =
            "mysql:
                host=$localhost;
                dbname=$database;
                charset=utf8";

        return new PDO($conexao, $user, $pass);
    }
}
