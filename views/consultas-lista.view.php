<?php require 'views/partials/header.view.php'; ?>

<h1>Consultas</h1>
<a href="index.php?acao=consultas-form" class="btn btn-primary mb-3">Nova Consulta</a>

<table class="table table-striped">
    <thead><tr><th>Data/Hora</th><th>Paciente</th><th>Profissional</th><th>Status</th><th>Ações</th></tr></thead>
    <tbody>
        <?php foreach ($consultas as $c): ?>
        <tr>
            <td><?= htmlspecialchars($c['data_hora']) ?></td>
            <td><?= htmlspecialchars($c['paciente_nome']) ?></td>
            <td><?= htmlspecialchars($c['profissional_nome']) ?></td>
            <td><span class="badge bg-info"><?= htmlspecialchars($c['status']) ?></span></td>
            <td><a href="index.php?acao=consultas-form&id=<?= $c['id'] ?>" class="btn btn-sm btn-warning">Editar</a></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require 'views/partials/footer.view.php'; ?>
