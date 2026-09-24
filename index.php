<?php
session_start();

// Token CSRF (um por sessão)
if (empty($_SESSION['csrf'])) {
    $_SESSION['csrf'] = bin2hex(random_bytes(32));
}
if ($_SERVER['REQUEST_METHOD'] === 'POST'
    && !hash_equals($_SESSION['csrf'], $_POST['csrf'] ?? '')) {
    http_response_code(403);
    exit('Requisição inválida (token CSRF).');
}

// Recurso: pega a ação pedida na URL (?acao=pacientes-lista)
$acao = $_GET['acao'] ?? 'login';

$acoesPublicas   = ['login', 'logout'];
$acoesProtegidas = [
    'pacientes-lista', 'pacientes-form',
    'profissionais-lista', 'profissionais-form',
    'consultas-lista', 'consultas-form',
];

// Só executa ações conhecidas (whitelist)
if (!in_array($acao, array_merge($acoesPublicas, $acoesProtegidas), true)) {
    http_response_code(404);
    exit('Erro 404: página não encontrada.');
}

// Protege tudo, exceto login/logout
if (!in_array($acao, $acoesPublicas, true) && empty($_SESSION['usuario_id'])) {
    header('Location: index.php?acao=login');
    exit;
}

require __DIR__ . '/controllers/' . $acao . '.controller.php';
