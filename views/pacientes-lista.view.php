<?php require 'views/partials/header.view.php'; ?>

<h1>Pacientes</h1>
<a href="index.php?acao=pacientes-form" class="btn btn-primary mb-3">Novo Paciente</a>

<table class="table table-striped">
    <thead><tr><th>Nome</th><th>CPF</th><th>Telefone</th><th>Ações</th></tr></thead>
    <tbody>
        <?php foreach ($pacientes as $p): ?>
        <tr>
            <td><?= htmlspecialchars($p['nome']) ?></td>
            <td><?= htmlspecialchars($p['cpf']) ?></td>
            <td><?= htmlspecialchars($p['telefone']) ?></td>
            <td><a href="index.php?acao=pacientes-form&id=<?= $p['id'] ?>" class="btn btn-sm btn-warning">Editar</a></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require 'views/partials/footer.view.php'; ?>
