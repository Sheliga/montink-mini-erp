<!DOCTYPE html>
<html>

<head>
    <title>Finalizar Pedido</title>
    <link href="<?= base_url('public/css/bootstrap.min.css') ?>" rel="stylesheet">
</head>

<body class="p-4">
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
                    <?php foreach ($itens as $item):
                        $total_item = (float)$item['preco'] * (int)$item['quantidade'];
                    ?>
                        <tr>
                            <td><?= htmlspecialchars($item['nome'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($item['variacao'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                            <td>R$ <?= number_format($item['preco'] ?? 0, 2, ',', '.') ?></td>
                            <td><?= $item['quantidade'] ?></td>
                            <td>R$ <?= number_format($total_item, 2, ',', '.') ?></td>
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

            <!-- Formulário para confirmar o pedido -->
            <form action="<?= site_url('carrinho/finalizar') ?>" method="post">
                <div class="form-group">
                    <label for="email_cliente">Seu e-mail:</label>
                    <input type="email" name="email_cliente" class="form-control" id="email_cliente" required>
                </div>

                <div class="form-group mt-3">
                    <label for="cep">CEP:</label>
                    <input type="text" name="cep" class="form-control" id="cep" required>
                </div>

                <div class="form-group mt-3">
                    <label for="endereco">Endereço completo:</label>
                    <textarea name="endereco" class="form-control" id="endereco" required></textarea>
                </div>

                <button type="submit" class="btn btn-success mt-4">Confirmar Pedido</button>
            </form>

            <a href="<?= site_url('carrinho') ?>" class="btn btn-secondary mt-3">Voltar ao Carrinho</a>
        <?php endif; ?>
    </div>
</body>

</html>