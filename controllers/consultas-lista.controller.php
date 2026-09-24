<?php
require_once 'models/consulta.model.php';
$consultas = listarConsultas();
require 'views/consultas-lista.view.php';
