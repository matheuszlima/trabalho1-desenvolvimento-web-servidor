<?php
require_once 'models/profissional.model.php';
$profissionais = listarProfissionais();
require 'views/profissionais-lista.view.php';
