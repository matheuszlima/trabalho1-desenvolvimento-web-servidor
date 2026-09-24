<?php
// Configuração da conexão com o banco de dados.
// Altere host, banco, usuário e senha conforme o seu ambiente.
function getConnection() {
    static $pdo = null; // reaproveita a mesma conexão durante a requisição
    if ($pdo !== null) {
        return $pdo;
    }

    $host = 'localhost';
    $db   = 'clinica_db';
    $user = 'root';
    $pass = '';

    try {
        $pdo = new PDO(
            "mysql:host=$host;dbname=$db;charset=utf8mb4",
            $user,
            $pass,
            [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]
        );
        return $pdo;
    } catch (PDOException $e) {
        error_log('Erro de conexão: ' . $e->getMessage());
        http_response_code(500);
        exit('Não foi possível conectar ao banco de dados. Verifique o arquivo config.php.');
    }
}
