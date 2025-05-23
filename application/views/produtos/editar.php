<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Editar Produto</title>

    <link href="<?= base_url(); ?>public/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 40px;
        }

        .card {
            border-radius: 12px;
        }

        .variacao-group {
            border-left: 4px solid #6c757d;
            background: #f1f1f1;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .btn-outline-secondary:hover {
            background-color: #e2e6ea;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="col-md-8 offset-md-2">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="card-title mb-4">✏️ Editar Produto</h3>

                    <?php if ($this->session->flashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= $this->session->flashdata('success') ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Fechar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>

                    <form method="post" action="<?= site_url('produtos/update/' . $produto->id) ?>">
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome do Produto</label>
                            <input type="text" id="nome" name="nome" class="form-control" required value="<?= $produto->nome ?>">
                        </div>

                        <div class="mb-3">
                            <label for="preco" class="form-label">Preço</label>
                            <input type="number" step="0.01" id="preco" name="preco" class="form-control" required value="<?= $produto->preco ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Variações de Estoque</label>
                            <div id="variacoes">
                                <?php foreach ($estoques as $estoque): ?>
                                    <div class="variacao-group row">
                                        <input type="hidden" name="estoque_ids[]" value="<?= $estoque->id ?>">
                                        <div class="col-md-6 mb-2">
                                            <input type="text" name="variacoes[nome][]" class="form-control" value="<?= $estoque->variacao ?>" required>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <input type="number" name="variacoes[quantidade][]" class="form-control" value="<?= $estoque->quantidade ?>" required>
                                        </div>
                                        <div class="col-md-2 mb-2 text-right">
                                            <button type="button" class="btn btn-outline-danger btn-sm" onclick="this.closest('.variacao-group').remove()" title="Remover Variação">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <button type="button" onclick="adicionarVariacao()" class="btn btn-outline-secondary btn-sm mt-2">
                                <i class="fas fa-plus"></i> Adicionar Variação
                            </button>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> Salvar Alterações
                            </button>
                            <a href="<?= site_url('produtos') ?>" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="<?= base_url(); ?>public/js/bootstrap.min.js"></script>

    <script>
        function adicionarVariacao() {
            const container = document.getElementById('variacoes');
            const div = document.createElement('div');
            div.className = 'variacao-group row';

            div.innerHTML = `
                <input type="hidden" name="estoque_ids[]" value="0">
                <div class="col-md-6 mb-2">
                    <input type="text" name="variacoes[nome][]" class="form-control" placeholder="Variação (ex: Tamanho M)" required>
                </div>
                <div class="col-md-4 mb-2">
                    <input type="number" name="variacoes[quantidade][]" class="form-control" placeholder="Quantidade" required>
                </div>
                <div class="col-md-2 mb-2 text-right">
                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="this.closest('.variacao-group').remove()" title="Remover Variação">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            `;

            container.appendChild(div);
        }
    </script>
</body>

</html>