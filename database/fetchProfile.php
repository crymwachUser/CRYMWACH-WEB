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

    $email = $_GET['email'];
    $stmt = $pdo->prepare('SELECT userid, fullname, gender, email, address, barangay, phone FROM register WHERE email = ?');
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    echo json_encode($user);

