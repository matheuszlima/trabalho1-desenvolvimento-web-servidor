<?php
require_once 'config.php';

function listarConsultas() {
    $pdo = getConnection();
    $sql = "SELECT c.*, p.nome AS paciente_nome, pr.nome AS profissional_nome
            FROM consultas c
            JOIN pacientes p ON p.id = c.paciente_id
            JOIN profissionais pr ON pr.id = c.profissional_id
            ORDER BY c.data_hora";
    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

function buscarConsultaPorId($id) {
    $pdo = getConnection();
    $stmt = $pdo->prepare("SELECT * FROM consultas WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function salvarConsulta($dados) {
    $pdo = getConnection();
    if (!empty($dados['id'])) {
        $stmt = $pdo->prepare(
            "UPDATE consultas SET paciente_id=?, profissional_id=?, data_hora=?, status=?, observacoes=? WHERE id=?"
        );
        $stmt->execute([
            $dados['paciente_id'], $dados['profissional_id'], $dados['data_hora'],
            $dados['status'], $dados['observacoes'], $dados['id']
        ]);
    } else {
        $stmt = $pdo->prepare(
            "INSERT INTO consultas (paciente_id, profissional_id, data_hora, status, observacoes) VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->execute([
            $dados['paciente_id'], $dados['profissional_id'], $dados['data_hora'],
            $dados['status'], $dados['observacoes']
        ]);
    }
}
