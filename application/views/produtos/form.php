<?php
$is_edit = isset($produto);
$action_url = $is_edit ? site_url("produtos/update/{$produto->id}") : site_url("produtos/criar");
?>

<style>
    body {
        background-color: #f8f9fa;
        padding-top: 40px;
    }

    .card {
        border-radius: 12px;
    }

    .form-section-title {
        font-weight: 600;
        margin-bottom: 0.5rem;
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

<div class="container mt-4">
    <div class="col-md-8 offset-md-2">
        <div class="card shadow-sm">
            <div class="card-body">
                <h3 class="card-title mb-4">
                    📦 <?= $is_edit ? 'Editar Produto' : 'Novo Produto' ?>
                </h3>

                <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= $this->session->flashdata('success') ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <form method="post" action="<?= $action_url ?>">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome do Produto</label>
                        <input type="text" id="nome" name="nome" class="form-control" required
                            value="<?= $is_edit ? htmlspecialchars($produto->nome) : '' ?>"
                            placeholder="Ex: Camiseta Básica">
                    </div>

                    <div class="mb-3">
                        <label for="preco" class="form-label">Preço</label>
                        <input type="number" step="0.01" id="preco" name="preco" class="form-control" required
                            value="<?= $is_edit ? $produto->preco : '' ?>" placeholder="Ex: 79.90">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Variações de Estoque</label>
                        <div id="variacoes">
                            <?php if (!empty($estoques)): ?>
                                <?php foreach ($estoques as $i => $estoque): ?>
                                    <div class="variacao-group row">
                                        <input type="hidden" name="estoque_ids[]" value="<?= $estoque->id ?>">
                                        <div class="col-md-6 mb-2">
                                            <input type="text" name="variacoes[nome][]" class="form-control"
                                                value="<?= htmlspecialchars($estoque->variacao) ?>"
                                                placeholder="Variação (ex: Tamanho P)" required>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <input type="number" name="variacoes[quantidade][]" class="form-control"
                                                value="<?= $estoque->quantidade ?>"
                                                placeholder="Quantidade" required>
                                        </div>
                                        <div class="col-md-2 mb-2 text-right">
                                            <button type="button" class="btn btn-outline-danger btn-sm"
                                                onclick="this.closest('.variacao-group').remove()">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <button type="button" onclick="adicionarVariacao()" class="btn btn-outline-secondary btn-sm mt-2">
                            <i class="fas fa-plus"></i> Adicionar Variação
                        </button>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> Salvar
                        </button>
                        <a href="<?= base_url() . 'produtos' ?>" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JS -->
<script>
    function adicionarVariacao() {
        const container = document.getElementById('variacoes');
        const div = document.createElement('div');
        div.className = 'variacao-group row';

        div.innerHTML = `
            <div class="col-md-6 mb-2">
                <input type="text" name="variacoes[nome][]" class="form-control" placeholder="Variação (ex: Tamanho P)" required>
            </div>
            <div class="col-md-4 mb-2">
                <input type="number" name="variacoes[quantidade][]" class="form-control" placeholder="Quantidade" required>
            </div>
            <div class="col-md-2 mb-2 text-right">
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="this.closest('.variacao-group').remove()">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        `;
        container.appendChild(div);
    }
</script>