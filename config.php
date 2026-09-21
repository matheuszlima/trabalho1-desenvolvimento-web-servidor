<?php
function getConnection() {
    $host = 'localhost';
    $db   = 'clinica_db';
    $user = 'root';
    $pass = '';
    try {
        return new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    } catch (PDOException $e) {
        trigger_error('Erro ao conectar ao banco: ' . $e->getMessage(), E_USER_ERROR);
    }
}