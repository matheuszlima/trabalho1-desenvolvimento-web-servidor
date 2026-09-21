<?php
session_start();

$acao = $_GET['acao'] ?? 'login';

$controlador = "controllers/" . $acao . ".controller.php";

if (file_exists($controlador)) {
    require $controlador;
} else {
    echo "Erro '$acao' ";
}