<?php
require_once 'config.php';

function listarProfissionais() {
    $pdo = getConnection();
    $stmt = $pdo->query("SELECT * FROM profissionais ORDER BY nome");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function buscarProfissionalPorId($id) {
    $pdo = getConnection();
    $stmt = $pdo->prepare("SELECT * FROM profissionais WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function salvarProfissional($dados) {
    $pdo = getConnection();
    if (!empty($dados['id'])) {
        $stmt = $pdo->prepare(
            "UPDATE profissionais SET nome=?, especialidade=?, registro=?, telefone=? WHERE id=?"
        );
        $stmt->execute([$dados['nome'], $dados['especialidade'], $dados['registro'], $dados['telefone'], $dados['id']]);
    } else {
        $stmt = $pdo->prepare(
            "INSERT INTO profissionais (nome, especialidade, registro, telefone) VALUES (?, ?, ?, ?)"
        );
        $stmt->execute([$dados['nome'], $dados['especialidade'], $dados['registro'], $dados['telefone']]);
    }
}
