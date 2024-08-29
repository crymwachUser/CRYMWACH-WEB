<?php

    $host = 'localhost';
    $db = 'crymwach';
    $user = 'root';
    $pass = '';
    $charset = 'utf8mb4';

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
    $stmt = $pdo->prepare('SELECT * FROM anonymousassestmentdata WHERE user_id = ?');
    $stmt->execute([$userid]);
    $user = $stmt->fetchAll();
    echo json_encode($user);

