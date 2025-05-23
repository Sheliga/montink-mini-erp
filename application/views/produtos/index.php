<?php $this->load->view('layouts/header', ['title' => 'Produtos']); ?>
<?php $this->load->view('layouts/navbar'); ?>

<div class="container">
    <h1 class="mb-4">Produtos</h1>

    <a href="<?= site_url('produtos/criar') ?>" class="btn btn-primary mb-3">Novo Produto</a>

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
                    <td><?= $produto['nome'] ?></td>
                    <td>R$ <?= number_format($produto['preco'], 2, ',', '.') ?></td>
                    <td>
                        <?php foreach ($produto['variacoes'] as $variacao): ?>
                            <!-- Exibe a variação com cores diferentes conforme quantidade -->
                            <span class="badge badge-<?= $variacao->quantidade < 5 ? 'danger' : ($variacao->quantidade < 10 ? 'warning' : 'secondary') ?> badge-variacao">
                                <?= $variacao->variacao ?> (<?= $variacao->quantidade ?>)
                            </span>
                        <?php endforeach; ?>
                    </td>
                    <td>
                        <?php foreach ($produto['variacoes'] as $variacao): ?>
                            <div class="d-flex flex-wrap mb-1">
                                <a href="<?= site_url('produtos/editar/' . $variacao->estoque_id) ?>"
                                    class="btn btn-outline-warning btn-sm mr-1 mb-1" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button"
                                    class="btn btn-outline-danger btn-sm mr-1 mb-1"
                                    data-toggle="modal"
                                    data-target="#modalConfirmarExclusao"
                                    data-id="<?= $variacao->estoque_id ?>"
                                    data-nome="<?= htmlspecialchars($variacao->variacao, ENT_QUOTES, 'UTF-8') ?>"
                                    data-tipo="produto"
                                    title="Excluir">
                                    <i class="fas fa-trash-alt"></i>
                                </button>

                                <a href="<?= site_url('carrinho/adicionar/' . $variacao->estoque_id) ?>"
                                    class="btn btn-outline-success btn-sm mb-1" title="Adicionar ao Carrinho">
                                    <i class="fas fa-cart-plus"></i>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php $this->load->view('layouts/footer'); ?>