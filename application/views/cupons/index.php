<?php $this->load->view('layouts/header', ['title' => 'Cupons']); ?>
<?php $this->load->view('layouts/navbar'); ?>

<div class="container">
    <h1 class="mb-4">Cupons</h1>

    <!-- Botão para criar novo cupom -->
    <a href="<?= site_url('cupons/create') ?>" class="btn btn-primary mb-3">Novo Cupom</a>

    <!-- Exibe mensagem de sucesso, se houver -->
    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $this->session->flashdata('success') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <!-- Tabela de cupons com estilo consistente com a página de produtos -->
    <table id="cuponsTable" class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Código</th>
                <th>Validade</th>
                <th>Valor Mínimo</th>
                <th>Desconto</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cupons as $cupom): ?>
                <tr>
                    <td><?= htmlspecialchars($cupom->codigo, ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($cupom->validade, ENT_QUOTES, 'UTF-8') ?></td>
                    <td>R$ <?= number_format($cupom->valor_minimo, 2, ',', '.') ?></td>
                    <td>R$ <?= number_format($cupom->desconto, 2, ',', '.') ?></td>
                    <td>
                        <a href="<?= site_url('cupons/edit/' . $cupom->id) ?>" class="btn btn-sm btn-warning">Editar</a>
                        <a href="#"
                            class="btn btn-sm btn-danger"
                            data-toggle="modal"
                            data-target="#modalConfirmarExclusao"
                            data-id="<?= $cupom->id ?>"
                            data-nome="<?= htmlspecialchars($cupom->codigo, ENT_QUOTES, 'UTF-8') ?>"
                            data-tipo="cupom"
                            onclick="return false;">
                            Excluir
                        </a>

                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php $this->load->view('layouts/footer'); ?>