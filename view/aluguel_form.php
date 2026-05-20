
<form method="post" action="alugueis.php">

    
    <input type="hidden" name="id" value="<?php echo isset($aluguelEdit) ? $aluguelEdit->getId() : ''; ?>">

    <div class="form-group">
        <label>Cliente:</label>
       
        <select name="cliente_id" required>
            <option value="">-- Selecione --</option>
            <?php foreach ($clientes as $c): ?>
                
                <option value="<?php echo $c->getId(); ?>"
                    <?php echo (isset($aluguelEdit) && $aluguelEdit->getClienteId() == $c->getId()) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($c->getNome()); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label>Veículo:</label>
   
        <select name="veiculo_id" required>
            <option value="">-- Selecione --</option>
            <?php foreach ($veiculos as $v): ?>
                <option value="<?php echo $v->getId(); ?>"
                    <?php echo (isset($aluguelEdit) && $aluguelEdit->getVeiculoId() == $v->getId()) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($v->getModelo() . ' ' . $v->getMarca()); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label>Data de Início:</label>
        <input type="date" name="data_inicio" required
               value="<?php echo isset($aluguelEdit) ? $aluguelEdit->getDataInicio() : ''; ?>">
    </div>

    <div class="form-group">
        <label>Data de Devolução:</label>
        <input type="date" name="data_fim" required
               value="<?php echo isset($aluguelEdit) ? $aluguelEdit->getDataFim() : ''; ?>">
    </div>

    <button type="submit" name="acao" value="salvar">
        <?php echo isset($aluguelEdit) ? '✏️ Atualizar' : '➕ Registrar'; ?>
    </button>

    <?php if (isset($aluguelEdit)): ?>
        <a href="alugueis.php" class="btn-cancelar">✖ Cancelar</a>
    <?php endif; ?>

</form>
