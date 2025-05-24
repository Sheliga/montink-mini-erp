<?php $this->load->view('layouts/header', ['title' => 'Criar Cupom']); ?>
<?php $this->load->view('layouts/navbar'); ?>

<div class="container">
    <h1 class="mb-4">Criar Cupom</h1>

    <form action="<?= site_url('cupons/insert') ?>" method="post">
        <div class="mb-3">
            <label for="codigo">Código</label>
            <input type="text" id="codigo" name="codigo" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="validade">Validade</label>
            <input type="date" id="validade" name="validade" class="form-control" required
                value="<?= date('Y-m-d', strtotime('+2 weeks')); ?>">
        </div>

        <div class="mb-3">
            <label for="tipo">Tipo de Desconto</label>
            <select id="tipo" name="tipo" class="form-control" required>
                <option value="reais">Reais (R$)</option>
                <option value="porcentagem">Porcentagem (%)</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="desconto">Desconto</label>
            <input type="number" id="desconto" name="desconto" class="form-control" step="0.01" required>
        </div>

        <div class="mb-3">
            <label for="valor_minimo">Valor Mínimo (opcional)</label>
            <input type="number" id="valor_minimo" name="valor_minimo" class="form-control" step="0.01">
        </div>

        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="<?= site_url('cupons') ?>" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php $this->load->view('layouts/footer'); ?>