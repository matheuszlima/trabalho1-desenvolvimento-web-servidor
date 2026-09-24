<?php
$_SESSION = [];
session_destroy();
header('Location: index.php?acao=login');
exit;
