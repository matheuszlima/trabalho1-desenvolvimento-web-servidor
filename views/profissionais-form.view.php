<?php require 'views/partials/header.view.php'; ?>

<h1><?= $profissional ? 'Editar' : 'Novo' ?> Profissional</h1>

<?php if (!empty($erros)): ?>
<div class="alert alert-danger">
    <ul class="mb-0">
        <?php foreach ($erros as $erro): ?><li><?= htmlspecialchars($erro) ?></li><?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>

<form method="POST" action="index.php?acao=profissionais-form">
    <input type="hidden" name="id" value="<?= htmlspecialchars($profissional['id'] ?? '') ?>">
    <input type="hidden" name="csrf" value="<?= htmlspecialchars($_SESSION['csrf']) ?>">
    <div class="mb-3">
        <label>Nome</label>
        <input type="text" name="nome" class="form-control" value="<?= htmlspecialchars($profissional['nome'] ?? '') ?>">
    </div>
    <div class="mb-3">
        <label>Especialidade</label>
        <input type="text" name="especialidade" class="form-control" value="<?= htmlspecialchars($profissional['especialidade'] ?? '') ?>">
    </div>
    <div class="mb-3">
        <label>Registro</label>
        <input type="text" name="registro" class="form-control" value="<?= htmlspecialchars($profissional['registro'] ?? '') ?>">
    </div>
    <div class="mb-3">
        <label>Telefone</label>
        <input type="text" name="telefone" class="form-control" value="<?= htmlspecialchars($profissional['telefone'] ?? '') ?>">
    </div>
    <button type="submit" class="btn btn-success">Salvar</button>
</form>

<?php require 'views/partials/footer.view.php'; ?>
