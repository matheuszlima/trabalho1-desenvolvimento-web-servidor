<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Início - Sistema da Clínica</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark bg-primary">
        <div class="container">
            <span class="navbar-brand">Sistema da Clínica</span>
            <a class="btn btn-light btn-sm" href="index.php?acao=logout">Sair</a>
        </div>
    </nav>

    <main class="container mt-4">
        <h2>Olá, <?= htmlspecialchars($_SESSION['usuario_nome']) ?>!</h2>
        <p>Você entrou no sistema.</p>

        <div class="alert alert-info">
            Os cadastros de pacientes, profissionais e consultas serão adicionados nas próximas partes.
        </div>
    </main>
</body>
</html>
