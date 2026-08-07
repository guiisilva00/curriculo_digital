<?php
try {
    $pdo = new PDO("mysql:host=localhost;port=3306;dbname=curriculo_digital;charset=utf8", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro: " . $e->getMessage());
}