<?php
require_once 'models/profissional.model.php';

$erros = [];
$profissional = !empty($_GET['id']) ? buscarProfissionalPorId($_GET['id']) : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome          = trim($_POST['nome'] ?? '');
    $especialidade = trim($_POST['especialidade'] ?? '');
    $registro      = trim($_POST['registro'] ?? '');
    $telefone      = trim($_POST['telefone'] ?? '');

    if ($nome === '') {
        $erros[] = 'O nome é obrigatório.';
    }
    if ($especialidade === '') {
        $erros[] = 'A especialidade é obrigatória.';
    }

    if (empty($erros)) {
        salvarProfissional([
            'id' => filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT) ?: null,
            'nome' => $nome, 'especialidade' => $especialidade,
            'registro' => $registro, 'telefone' => $telefone,
        ]);
        header('Location: index.php?acao=profissionais-lista');
        exit;
    } else {
        $profissional = $_POST;
    }
}

require 'views/profissionais-form.view.php';
