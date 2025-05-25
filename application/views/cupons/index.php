<?php $this->load->view('layouts/header', ['title' => 'Cupons']); ?>
<?php $this->load->view('layouts/navbar'); ?>
<div class="vertical-center-wrapper">
    <div class="container">
        <h1 class="mb-4">Cupons</h1>

        <a href="<?= site_url('cupons/create') ?>" class="btn btn-primary mb-3">Novo Cupom</a>

        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $this->session->flashdata('success') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <div class="table-responsive">
            <table id="cuponsTable" class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Código</th>
                        <th>Validade</th>
                        <th>Valor Mínimo</th>
                        <th>Desconto</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cupons as $cupom): ?>
                        <tr>
                            <td><?= htmlspecialchars($cupom->codigo) ?></td>
                            <td><?= date('d/m/Y', strtotime($cupom->validade)) ?></td>
                            <td>R$ <?= number_format($cupom->valor_minimo, 2, ',', '.') ?></td>
                            <td>R$ <?= number_format($cupom->desconto, 2, ',', '.') ?></td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center flex-wrap">
                                    <a href="<?= site_url('cupons/edit/' . $cupom->id) ?>"
                                        class="btn btn-sm btn-outline-warning mr-1 mb-1"
                                        title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button"
                                        class="btn btn-sm btn-outline-danger mb-1"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalConfirmarExclusao"
                                        data-id="<?= $cupom->id ?>"
                                        data-nome="<?= htmlspecialchars($cupom->codigo) ?>"
                                        data-tipo="cupom"
                                        title="Excluir">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php $this->load->view('layouts/footer'); ?>