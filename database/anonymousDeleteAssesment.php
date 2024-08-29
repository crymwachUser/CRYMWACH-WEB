<?php

$host = 'localhost';
$db = 'crymwach';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

if (isset($_GET['id'])) {
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }

    $submitid = $_GET['id'];
    $stmt = $pdo->prepare('DELETE FROM anonymousassestmentdata WHERE submitid = ?');
    $stmt->execute([$submitid]);
} else if (isset($_GET['submitid'])) {
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }

    $submitid = $_GET['submitid'];
    $stmt = $pdo->prepare('DELETE FROM assestmentdata WHERE submitid = ?');
    $stmt->execute([$submitid]);
}
