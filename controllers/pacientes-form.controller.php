<?php
require_once 'models/paciente.model.php';

// Valida CPF pelo algoritmo dos dígitos verificadores (recebe só dígitos)
function cpfValido(string $cpf): bool {
    if (strlen($cpf) !== 11 || preg_match('/^(\d)\1{10}$/', $cpf)) {
        return false;
    }
    for ($t = 9; $t < 11; $t++) {
        $soma = 0;
        for ($i = 0; $i < $t; $i++) {
            $soma += $cpf[$i] * (($t + 1) - $i);
        }
        if ($cpf[$t] != ((10 * $soma) % 11) % 10) {
            return false;
        }
    }
    return true;
}

$erros = [];
$paciente = !empty($_GET['id']) ? buscarPacientePorId($_GET['id']) : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id              = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT) ?: null;
    $nome            = trim($_POST['nome'] ?? '');
    $cpf             = preg_replace('/\D/', '', $_POST['cpf'] ?? ''); // só dígitos
    $telefone        = trim($_POST['telefone'] ?? '');
    $email           = trim($_POST['email'] ?? '');
    $data_nascimento = trim($_POST['data_nascimento'] ?? '');
    $endereco        = trim($_POST['endereco'] ?? '');

    if ($nome === '') {
        $erros[] = 'O nome é obrigatório.';
    }

    if (!cpfValido($cpf)) {
        $erros[] = 'CPF inválido.';
    } elseif (cpfJaCadastrado($cpf, $id)) {
        $erros[] = 'Já existe um paciente cadastrado com este CPF.';
    }

    if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erros[] = 'E-mail inválido.';
    }

    if ($data_nascimento !== '') {
        $d = DateTime::createFromFormat('Y-m-d', $data_nascimento);
        if (!$d || $d->format('Y-m-d') !== $data_nascimento) {
            $erros[] = 'Data de nascimento inválida.';
        } elseif ($d > new DateTime('today')) {
            $erros[] = 'A data de nascimento não pode ser futura.';
        }
    }

    if (empty($erros)) {
        try {
            salvarPaciente([
                'id' => $id,
                'nome' => $nome, 'cpf' => $cpf, 'telefone' => $telefone,
                'email' => $email, 'data_nascimento' => $data_nascimento, 'endereco' => $endereco,
            ]);
            header('Location: index.php?acao=pacientes-lista');
            exit;
        } catch (PDOException $e) {
            // 23000 = violação de chave única (CPF duplicado em cadastros simultâneos)
            $erros[] = ($e->getCode() === '23000')
                ? 'Já existe um paciente cadastrado com este CPF.'
                : 'Erro ao salvar o paciente. Tente novamente.';
        }
    }

    $paciente = $_POST;
}

require 'views/pacientes-form.view.php';
