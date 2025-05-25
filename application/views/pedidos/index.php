<?php
// Código defensivo para garantir que $orders exista e seja iterável
if (!isset($orders) || !is_array($orders)) {
    $orders = [];
}
?>
<div class="vertical-center-wrapper">
    <div class="container mt-5">
        <h2 class="mb-4">Pedidos</h2>

        <!-- Container responsivo para a tabela -->
        <div class="table-responsive">
            <table id="pedidosTable" class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Produtos</th>
                        <th>Subtotal</th>
                        <th>Frete</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Data do Pedido</th>

                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($orders)): ?>
                        <tr>
                            <td colspan="7" class="text-center">Nenhum pedido encontrado.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($orders as $order): ?>
                            <tr>
                                <td><?= htmlspecialchars($order->id, ENT_QUOTES, 'UTF-8') ?></td>
                                <td>
                                    <?php
                                    // Converte a string JSON dos produtos em array
                                    $produtos = json_decode($order->produtos_serializados, true);
                                    $names = [];
                                    if (is_array($produtos)) {
                                        foreach ($produtos as $produto) {
                                            if (isset($produto['nome'])) {
                                                $names[] = htmlspecialchars($produto['nome'], ENT_QUOTES, 'UTF-8');
                                            }
                                        }
                                        echo implode(', ', $names);
                                    } else {
                                        echo 'N/A';
                                    }
                                    ?>
                                </td>
                                <td>R$ <?= number_format($order->subtotal, 2, ',', '.') ?></td>
                                <td>R$ <?= number_format($order->frete, 2, ',', '.') ?></td>
                                <td>R$ <?= number_format($order->total, 2, ',', '.') ?></td>
                                <td><?= htmlspecialchars($order->status, ENT_QUOTES, 'UTF-8') ?></td>
                                <td><?= date('d/m/Y H:i:s', strtotime($order->created_at)) ?></td>

                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>