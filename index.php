<?php
session_start();

$acao = $_GET['acao'] ?? 'login';

$acoesPermitidas = ['login', 'inicio', 'logout'];

if (!in_array($acao, $acoesPermitidas)) {
    $acao = 'login';
}

$controlador = __DIR__ . "/controllers/" . $acao . ".controller.php";

require $controlador;
