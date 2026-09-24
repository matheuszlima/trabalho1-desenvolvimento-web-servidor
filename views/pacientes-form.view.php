<?php require 'views/partials/header.view.php'; ?>

<h1><?= $paciente ? 'Editar' : 'Novo' ?> Paciente</h1>

<?php if (!empty($erros)): ?>
<div class="alert alert-danger">
    <ul class="mb-0">
        <?php foreach ($erros as $erro): ?><li><?= htmlspecialchars($erro) ?></li><?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>

<form method="POST" action="index.php?acao=pacientes-form">
    <input type="hidden" name="id" value="<?= htmlspecialchars($paciente['id'] ?? '') ?>">
    <input type="hidden" name="csrf" value="<?= htmlspecialchars($_SESSION['csrf']) ?>">
    <div class="mb-3">
        <label>Nome</label>
        <input type="text" name="nome" class="form-control" value="<?= htmlspecialchars($paciente['nome'] ?? '') ?>">
    </div>
    <div class="mb-3">
        <label>CPF</label>
        <input type="text" name="cpf" class="form-control" value="<?= htmlspecialchars($paciente['cpf'] ?? '') ?>">
    </div>
    <div class="mb-3">
        <label>Telefone</label>
        <input type="text" name="telefone" class="form-control" value="<?= htmlspecialchars($paciente['telefone'] ?? '') ?>">
    </div>
    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($paciente['email'] ?? '') ?>">
    </div>
    <div class="mb-3">
        <label>Data de Nascimento</label>
        <input type="date" name="data_nascimento" class="form-control" value="<?= htmlspecialchars($paciente['data_nascimento'] ?? '') ?>">
    </div>
    <div class="mb-3">
        <label>Endereço</label>
        <input type="text" name="endereco" class="form-control" value="<?= htmlspecialchars($paciente['endereco'] ?? '') ?>">
    </div>
    <button type="submit" class="btn btn-success">Salvar</button>
</form>

<?php require 'views/partials/footer.view.php'; ?>
