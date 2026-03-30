<?php

require_once 'configs/Database.php';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int) $e->getCode());
}

class Databaser
{
    public static function runQuery($query, $param = [])
    {
        global $pdo;
        $stmt = $pdo->prepare($query);
        $stmt->execute($param);

        return $stmt->fetch();
    }
}
