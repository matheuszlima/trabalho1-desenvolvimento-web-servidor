<?php

if (!isset($_SESSION['usuario_id'])) {
    header('Location: index.php?acao=login');
    exit;
}

require __DIR__ . '/../views/inicio.php';
