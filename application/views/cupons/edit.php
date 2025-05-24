<?php $this->load->view('layouts/header', ['title' => 'Editar Cupom']); ?>
<?php $this->load->view('layouts/navbar'); ?>

<div class="container">
    <h1 class="mb-4">Editar Cupom</h1>

    <form action="<?= site_url('cupons/update/' . $cupom->id) ?>" method="post">
        <div class="mb-3">
            <label for="codigo">Código</label>
            <input type="text" id="codigo" name="codigo" class="form-control"
                value="<?= htmlspecialchars($cupom->codigo, ENT_QUOTES, 'UTF-8') ?>" required>
        </div>

        <div class="mb-3">
            <label for="validade">Validade</label>
            <input type="date" id="validade" name="validade" class="form-control"
                value="<?= htmlspecialchars($cupom->validade, ENT_QUOTES, 'UTF-8') ?>" required>
        </div>

        <div class="mb-3">
            <label for="tipo">Tipo de Desconto</label>
            <select id="tipo" name="tipo" class="form-control" required>
                <option value="reais" <?= $cupom->tipo === 'reais' ? 'selected' : '' ?>>Reais (R$)</option>
                <option value="porcentagem" <?= $cupom->tipo === 'porcentagem' ? 'selected' : '' ?>>Porcentagem (%)</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="desconto">Desconto</label>
            <input type="number" id="desconto" name="desconto" class="form-control"
                value="<?= htmlspecialchars($cupom->desconto, ENT_QUOTES, 'UTF-8') ?>" step="0.01" required>
        </div>

        <div class="mb-3">
            <label for="valor_minimo">Valor Mínimo (opcional)</label>
            <input type="number" id="valor_minimo" name="valor_minimo" class="form-control"
                value="<?= htmlspecialchars($cupom->valor_minimo, ENT_QUOTES, 'UTF-8') ?>" step="0.01">
        </div>

        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a href="<?= site_url('cupons') ?>" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php $this->load->view('layouts/footer'); ?>