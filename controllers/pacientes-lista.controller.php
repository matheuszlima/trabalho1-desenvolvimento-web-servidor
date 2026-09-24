<?php
require_once 'models/paciente.model.php';
$pacientes = listarPacientes();
require 'views/pacientes-lista.view.php';
