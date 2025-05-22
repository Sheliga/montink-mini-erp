<!DOCTYPE html>
<html>
<link href="<?php echo base_url(); ?>public/css/bootstrap.min.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>

<head>
    <title>Criar Produto</title>
    <script>
        function adicionarVariacao() {
            const container = document.getElementById('variacoes');
            const div = document.createElement('div');
            div.className = 'mb-2 row';
            div.innerHTML = `
                <div class="col">
                    <input type="text" name="variacoes[nome][]" class="form-control" placeholder="Variação (ex: Tamanho P)" required>
                </div>
                <div class="col">
                    <input type="number" name="variacoes[quantidade][]" class="form-control" placeholder="Quantidade" required>
                </div>
            `;
            container.appendChild(div);
        }
    </script>
</head>

<body class="p-4">
    <div class="container">
        <h1>Novo Produto</h1>
        <form method="post" action="<?= site_url('produtos/criar') ?>">
            <div class="mb-3">
                <label>Nome</label>
                <input type="text" name="nome" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Preço</label>
                <input type="number" step="0.01" name="preco" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Variações de Estoque</label>
                <div id="variacoes"></div>
                <button type="button" onclick="adicionarVariacao()" class="btn btn-sm btn-secondary mt-2">Adicionar Variação</button>
            </div>

            <button class="btn btn-success">Salvar</button>
            <a href="<?= site_url('produtos') ?>" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>

</html>