<?php require 'views/partials/header.view.php'; ?>

<h1>Profissionais</h1>
<a href="index.php?acao=profissionais-form" class="btn btn-primary mb-3">Novo Profissional</a>

<table class="table table-striped">
    <thead><tr><th>Nome</th><th>Especialidade</th><th>Registro</th><th>Ações</th></tr></thead>
    <tbody>
        <?php foreach ($profissionais as $p): ?>
        <tr>
            <td><?= htmlspecialchars($p['nome']) ?></td>
            <td><?= htmlspecialchars($p['especialidade']) ?></td>
            <td><?= htmlspecialchars($p['registro']) ?></td>
            <td><a href="index.php?acao=profissionais-form&id=<?= $p['id'] ?>" class="btn btn-sm btn-warning">Editar</a></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require 'views/partials/footer.view.php'; ?>
