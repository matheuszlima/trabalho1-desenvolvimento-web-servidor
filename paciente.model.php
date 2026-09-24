<?php
require_once 'config.php';

function listarPacientes() {
    $pdo = getConnection();
    $stmt = $pdo->query("SELECT * FROM pacientes ORDER BY nome");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function buscarPacientePorId($id) {
    $pdo = getConnection();
    $stmt = $pdo->prepare("SELECT * FROM pacientes WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function salvarPaciente($dados) {
    $pdo = getConnection();
    // Data opcional: string vazia vira NULL (evita erro na coluna DATE)
    $dataNasc = !empty($dados['data_nascimento']) ? $dados['data_nascimento'] : null;
    if (!empty($dados['id'])) {
        $stmt = $pdo->prepare(
            "UPDATE pacientes SET nome=?, cpf=?, telefone=?, email=?, data_nascimento=?, endereco=? WHERE id=?"
        );
        $stmt->execute([
            $dados['nome'], $dados['cpf'], $dados['telefone'],
            $dados['email'], $dataNasc, $dados['endereco'], $dados['id']
        ]);
    } else {
        $stmt = $pdo->prepare(
            "INSERT INTO pacientes (nome, cpf, telefone, email, data_nascimento, endereco) VALUES (?, ?, ?, ?, ?, ?)"
        );
        $stmt->execute([
            $dados['nome'], $dados['cpf'], $dados['telefone'],
            $dados['email'], $dataNasc, $dados['endereco']
        ]);
    }
}

// Verifica se já existe outro paciente com o mesmo CPF (ignora o próprio registro na edição)
function cpfJaCadastrado($cpf, $idIgnorar = null) {
    $pdo = getConnection();
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM pacientes WHERE cpf = ? AND id <> ?");
    $stmt->execute([$cpf, $idIgnorar ?? 0]);
    return $stmt->fetchColumn() > 0;
}
