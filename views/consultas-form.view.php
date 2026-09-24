<?php require 'views/partials/header.view.php'; ?>

<h1><?= $consulta ? 'Editar' : 'Nova' ?> Consulta</h1>

<?php if (!empty($erros)): ?>
<div class="alert alert-danger">
    <ul class="mb-0">
        <?php foreach ($erros as $erro): ?><li><?= htmlspecialchars($erro) ?></li><?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>

<form method="POST" action="index.php?acao=consultas-form">
    <input type="hidden" name="id" value="<?= htmlspecialchars($consulta['id'] ?? '') ?>">
    <input type="hidden" name="csrf" value="<?= htmlspecialchars($_SESSION['csrf']) ?>">

    <div class="mb-3">
        <label>Paciente</label>
        <select name="paciente_id" class="form-control">
            <option value="">Selecione...</option>
            <?php foreach ($pacientes as $p): ?>
                <option value="<?= $p['id'] ?>" <?= (($consulta['paciente_id'] ?? '') == $p['id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($p['nome']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label>Profissional</label>
        <select name="profissional_id" class="form-control">
            <option value="">Selecione...</option>
            <?php foreach ($profissionais as $p): ?>
                <option value="<?= $p['id'] ?>" <?= (($consulta['profissional_id'] ?? '') == $p['id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($p['nome']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label>Data e Hora</label>
        <input type="datetime-local" name="data_hora" class="form-control" value="<?= htmlspecialchars($consulta['data_hora'] ?? '') ?>">
    </div>

    <div class="mb-3">
        <label>Status</label>
        <select name="status" class="form-control">
            <?php foreach (['agendada', 'confirmada', 'realizada', 'cancelada'] as $s): ?>
                <option value="<?= $s ?>" <?= (($consulta['status'] ?? 'agendada') === $s) ? 'selected' : '' ?>><?= ucfirst($s) ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label>Observações</label>
        <textarea name="observacoes" class="form-control"><?= htmlspecialchars($consulta['observacoes'] ?? '') ?></textarea>
    </div>

    <button type="submit" class="btn btn-success">Salvar</button>
</form>

<?php require 'views/partials/footer.view.php'; ?>
