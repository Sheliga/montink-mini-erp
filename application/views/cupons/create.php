<!DOCTYPE html>
<html>

<head>
    <title>Criar Cupom</title>
    <link href="<?php echo base_url(); ?>public/css/bootstrap.min.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>
</head>

<body class="p-4">
    <div class="container">
        <h1>Criar Cupom</h1>

        <form action="<?= site_url('cupons/insert') ?>" method="post">
            <div class="mb-3">
                <label>Código</label>
                <input type="text" name="codigo" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Validade</label>
                <input type="date" name="validade" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Tipo de Desconto</label>
                <select name="tipo" class="form-control" required>
                    <option value="reais">Reais (R$)</option>
                    <option value="porcentagem">Porcentagem (%)</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Desconto</label>
                <input type="number" name="desconto" class="form-control" step="0.01" required>
            </div>

            <div class="mb-3">
                <label>Valor Mínimo (opcional)</label>
                <input type="number" name="valor_minimo" class="form-control" step="0.01">
            </div>

            <button class="btn btn-success">Salvar</button>
            <a href="<?= site_url('cupons') ?>" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>

</html>