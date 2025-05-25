<div class="container mt-5">
    <h2 class="mb-4">Finalizar Pedido</h2>

    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
    <?php endif; ?>

    <?php if (empty($itens)): ?>
        <div class="alert alert-info">Seu carrinho está vazio.</div>
        <a href="<?= site_url('produtos') ?>" class="btn btn-primary">Voltar aos Produtos</a>
    <?php else: ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Variação</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($itens as $item): ?>
                    <tr>
                        <td><?= htmlspecialchars($item['nome']) ?></td>
                        <td><?= htmlspecialchars($item['variacao']) ?></td>
                        <td>R$ <?= number_format($item['preco'], 2, ',', '.') ?></td>
                        <td><?= (int)$item['quantidade'] ?></td>
                        <td>R$ <?= number_format($item['preco'] * $item['quantidade'], 2, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4" class="text-right">Subtotal:</th>
                    <th>R$ <?= number_format($subtotal, 2, ',', '.') ?></th>
                </tr>
                <tr>
                    <th colspan="4" class="text-right">Frete:</th>
                    <th>R$ <?= number_format($frete, 2, ',', '.') ?></th>
                </tr>
                <tr>
                    <th colspan="4" class="text-right">Total:</th>
                    <th>R$ <?= number_format($total, 2, ',', '.') ?></th>
                </tr>
            </tfoot>
        </table>

        <form action="<?= site_url('carrinho/finalizar') ?>" method="post">
            <div class="form-group">
                <label for="email_cliente">Seu e-mail:</label>
                <input type="email" name="email_cliente" class="form-control" id="email_cliente" required>
            </div>

            <?php $this->load->view('carrinho/_form_endereco'); ?>

            <button type="submit" class="btn btn-success mt-4">Confirmar Pedido</button>
        </form>

        <a href="<?= site_url('carrinho') ?>" class="btn btn-secondary mt-3">Voltar ao Carrinho</a>
    <?php endif; ?>
</div>

<!-- Script de endereço via CEP -->
<script src="<?= base_url('assets/js/endereco.js') ?>"></script>