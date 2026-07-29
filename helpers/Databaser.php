<?php

require_once 'configs/Database.php';
require_once 'helpers/Responser.php';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    Responser::custom(500, 'error', 'Database error.', ['error' => $e->getMessage()]);
}

class Databaser
{
    public static function runQuery($query, $param = [])
    {
        global $pdo;
        $stmt = $pdo->prepare($query);
        $stmt->execute($param);

        return $stmt;
    }

    public static function startTransaction()
    {
        global $pdo;
        $pdo->beginTransaction();
    }

    public static function commit()
    {
        global $pdo;
        $pdo->commit();
    }

    public static function rollback()
    {
        global $pdo;
        $pdo->rollback();
    }
}
