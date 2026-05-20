
<form method="post" action="veiculos.php">
   
    <input type="hidden" name="id" value="<?php echo isset($veiculoEdit) ? $veiculoEdit->getId() : ''; ?>">

    <div class="form-group">
        <label>Modelo:</label>
        <input type="text" name="modelo" required placeholder="Ex: Civic"
               value="<?php echo isset($veiculoEdit) ? htmlspecialchars($veiculoEdit->getModelo()) : ''; ?>">
    </div>

    <div class="form-group">
        <label>Marca:</label>
        <input type="text" name="marca" required placeholder="Ex: Honda"
               value="<?php echo isset($veiculoEdit) ? htmlspecialchars($veiculoEdit->getMarca()) : ''; ?>">
    </div>

    <div class="form-group">
        <label>Placa:</label>
        <input type="text" name="placa" required placeholder="Ex: ABC-1234"
               value="<?php echo isset($veiculoEdit) ? htmlspecialchars($veiculoEdit->getPlaca()) : ''; ?>">
    </div>

    <div class="form-group">
        <label>Ano:</label>
        <input type="number" name="ano" required placeholder="Ex: 2022"
               value="<?php echo isset($veiculoEdit) ? $veiculoEdit->getAno() : ''; ?>">
    </div>

    <div class="form-group">
        <label>Valor da Diária (R$):</label>
        <input type="number" step="0.01" name="diaria" required placeholder="Ex: 150.00"
               value="<?php echo isset($veiculoEdit) ? $veiculoEdit->getDiaria() : ''; ?>">
    </div>

    <button type="submit" name="acao" value="salvar">
        <?php echo isset($veiculoEdit) ? '✏️ Atualizar' : '➕ Cadastrar'; ?>
    </button>

    <?php if (isset($veiculoEdit)): ?>
        <a href="veiculos.php" class="btn-cancelar">✖ Cancelar</a>
    <?php endif; ?>

</form>
