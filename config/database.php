<?php
// Conexao unica do projeto. Quem inclui este arquivo decide como tratar a falha,
// por isso aqui nao ha try/catch: a PDOException sobe para o chamador.

$host     = 'localhost';
$dbname   = 'escola_taekwondo';
$username = 'root';
$password = '';

$pdo = new PDO(
    "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
    $username,
    $password,
    [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ]
);
