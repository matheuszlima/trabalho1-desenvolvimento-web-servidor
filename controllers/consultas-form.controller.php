<?php
require_once 'models/consulta.model.php';
require_once 'models/paciente.model.php';
require_once 'models/profissional.model.php';

$statusPermitidos = ['agendada', 'confirmada', 'realizada', 'cancelada'];

$erros = [];
$consulta = null;
if (!empty($_GET['id'])) {
    $consulta = buscarConsultaPorId($_GET['id']);
    if ($consulta) {
        // datetime-local exige o formato Y-m-d\TH:i
        $consulta['data_hora'] = date('Y-m-d\TH:i', strtotime($consulta['data_hora']));
    }
}
$pacientes = listarPacientes();
$profissionais = listarProfissionais();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id              = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT) ?: null;
    $paciente_id     = filter_var($_POST['paciente_id'] ?? '', FILTER_VALIDATE_INT);
    $profissional_id = filter_var($_POST['profissional_id'] ?? '', FILTER_VALIDATE_INT);
    $data_hora       = trim($_POST['data_hora'] ?? '');
    $status          = $_POST['status'] ?? '';
    $observacoes     = trim($_POST['observacoes'] ?? '');

    if (!$paciente_id || !buscarPacientePorId($paciente_id)) {
        $erros[] = 'Selecione um paciente válido.';
    }
    if (!$profissional_id || !buscarProfissionalPorId($profissional_id)) {
        $erros[] = 'Selecione um profissional válido.';
    }
    if (!in_array($status, $statusPermitidos, true)) {
        $erros[] = 'Status inválido.';
    }
    $dt = DateTime::createFromFormat('Y-m-d\TH:i', $data_hora);
    if (!$dt || $dt->format('Y-m-d\TH:i') !== $data_hora) {
        $erros[] = 'Informe uma data e hora válidas.';
    }

    if (empty($erros)) {
        try {
            salvarConsulta([
                'id' => $id,
                'paciente_id' => $paciente_id, 'profissional_id' => $profissional_id,
                'data_hora' => $dt->format('Y-m-d H:i:s'), 'status' => $status, 'observacoes' => $observacoes,
            ]);
            header('Location: index.php?acao=consultas-lista');
            exit;
        } catch (PDOException $e) {
            $erros[] = 'Erro ao salvar a consulta. Tente novamente.';
        }
    }

    $consulta = $_POST;
}

require 'views/consultas-form.view.php';
