<?php

if (isset($_SESSION['usuario_id'])) {
    header('Location: index.php?acao=inicio');
    exit;
}

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../models/Usuario.php';

$erro = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';

    if ($email === '' || $senha === '') {
        $erro = 'Preencha o e-mail e a senha.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = 'Digite um e-mail válido.';
    } else {
        try {
            $usuarioModel = new Usuario(getConnection());
            $usuario = $usuarioModel->buscarPorEmail($email);

            if ($usuario && password_verify($senha, $usuario['senha'])) {
                session_regenerate_id(true);
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_nome'] = $usuario['nome'];

                header('Location: index.php?acao=inicio');
                exit;
            }

            $erro = 'E-mail ou senha incorretos.';
        } catch (PDOException $e) {
            $erro = 'Não foi possível entrar. Verifique se o banco foi configurado.';
        }
    }
}

require __DIR__ . '/../views/login.php';
