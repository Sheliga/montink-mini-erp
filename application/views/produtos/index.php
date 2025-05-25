<?php $this->load->view('layouts/header', ['title' => 'Produtos']); ?>
<?php $this->load->view('layouts/navbar'); ?>
<div class="vertical-center-wrapper">
    <div class="container">
        <h1 class="mb-4">Produtos</h1>

        <a href="<?= base_url() . 'produtos/criar' ?>" class="btn btn-primary mb-3">Novo Produto</a>

        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $this->session->flashdata('success') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <table id="produtosTable" class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Variações</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produtos_agrupados as $produto): ?>
                    <tr>
                        <td><?= $produto['id'] ?></td>
                        <td><?= htmlspecialchars($produto['nome'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td>R$ <?= number_format($produto['preco'], 2, ',', '.') ?></td>
                        <td>
                            <?php foreach ($produto['variacoes'] as $variacao): ?>
                                <?php
                                $classeBadge = 'secondary';
                                if ($variacao->quantidade < 5) $classeBadge = 'danger';
                                elseif ($variacao->quantidade < 10) $classeBadge = 'warning';
                                ?>
                                <span class="badge badge-<?= $classeBadge ?> badge-variacao">
                                    <?= htmlspecialchars($variacao->variacao, ENT_QUOTES, 'UTF-8') ?> (<?= $variacao->quantidade ?>)
                                </span>
                            <?php endforeach; ?>
                        </td>
                        <td>
                            <div class="d-flex flex-wrap align-items-center">
                                <!-- Botão Editar (por produto) -->
                                <a href="<?= base_url('produtos/editar/' . $produto['id']) ?>"
                                    class="btn btn-outline-warning btn-sm mr-1 mb-1"
                                    title="Editar Produto">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <!-- Botão Excluir (por produto) -->
                                <button type="button"
                                    class="btn btn-outline-danger btn-sm mr-1 mb-1"
                                    data-toggle="modal"
                                    data-target="#modalConfirmarExclusao"
                                    data-id="<?= $produto['id'] ?>"
                                    data-nome="<?= htmlspecialchars($produto['nome'], ENT_QUOTES, 'UTF-8') ?>"
                                    data-tipo="produto"
                                    title="Excluir Produto">
                                    <i class="fas fa-trash-alt"></i>
                                </button>

                                <!-- Botões Adicionar ao Carrinho (um por variação) -->
                                <?php foreach ($produto['variacoes'] as $variacao): ?>
                                    <a href="<?= site_url('carrinho/adicionar/' . $variacao->estoque_id) ?>"
                                        class="btn btn-outline-success btn-sm mr-1 mb-1"
                                        title="Adicionar <?= htmlspecialchars($variacao->variacao) ?> ao Carrinho">
                                        <i class="fas fa-cart-plus"></i>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php $this->load->view('layouts/footer'); ?>