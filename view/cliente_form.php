
    <input type="hidden" name="id" value="<?php echo isset($clienteEdit) ? $clienteEdit->getId() : ''; ?>">

    <div class="form-group">
        <label>Nome:</label>
        <input type="text" name="nome" required placeholder="Ex: João da Silva"
               value="<?php echo isset($clienteEdit) ? htmlspecialchars($clienteEdit->getNome()) : ''; ?>">
    </div>

    <div class="form-group">
        <label>CPF:</label>
        <input type="text" name="cpf" required placeholder="Ex: 000.000.000-00"
               value="<?php echo isset($clienteEdit) ? htmlspecialchars($clienteEdit->getCpf()) : ''; ?>">
    </div>

    <div class="form-group">
        <label>Telefone:</label>
        <input type="text" name="telefone" placeholder="Ex: (88) 99999-9999"
               value="<?php echo isset($clienteEdit) ? htmlspecialchars($clienteEdit->getTelefone()) : ''; ?>">
    </div>

    <div class="form-group">
        <label>E-mail:</label>
        <input type="email" name="email" placeholder="Ex: joao@email.com"
               value="<?php echo isset($clienteEdit) ? htmlspecialchars($clienteEdit->getEmail()) : ''; ?>">
    </div>

    <button type="submit" name="acao" value="salvar">
        <?php echo isset($clienteEdit) ? '✏️ Atualizar' : '➕ Cadastrar'; ?>
    </button>

    <?php if (isset($clienteEdit)): ?>
        <a href="clientes.php" class="btn-cancelar">✖ Cancelar</a>
    <?php endif; ?>

</form>
