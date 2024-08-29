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

    $userid = $_GET['id'];
    $stmt = $pdo->prepare('SELECT * FROM assestmentdata WHERE user_id = ?');
    $stmt->execute([$userid]);
    $user = $stmt->fetchAll();
    echo json_encode($user);
} else if (isset($_GET['anonymousid'])) {
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

    $anonymousid = $_GET['anonymousid'];
    $stmt = $pdo->prepare('SELECT COUNT(user_id) AS anonymousCount FROM anonymousassestmentdata WHERE user_id = ?');
    $stmt->execute([$anonymousid]);
    $count = $stmt->fetch(PDO::FETCH_ASSOC);
    $anonymousCount = $count['anonymousCount'];
    echo json_encode(["anonymousCount" => $anonymousCount]);
} else if (isset($_GET['informationid'])) {
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

    $infoid = $_GET['informationid'];
    $stmt = $pdo->prepare('SELECT COUNT(user_id) AS infoCount FROM assestmentdata WHERE user_id = ?');
    $stmt->execute([$infoid]);
    $count = $stmt->fetch(PDO::FETCH_ASSOC);
    $infoCount = $count['infoCount'];
    echo json_encode(["infoCount" => $infoCount]);
}else if (isset($_GET['crvid'])) {
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

    $stmt = $pdo->prepare('SELECT COUNT(id) AS crvCount FROM vrc');
    $stmt->execute();
    $count = $stmt->fetch(PDO::FETCH_ASSOC);
    $crvCount = $count['crvCount'];
    echo json_encode(["crvCount" => $crvCount]);
}
