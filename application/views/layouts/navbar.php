<?php
// Obter a instância do CI para acesso à sessão
$CI = &get_instance();
// Recupera o carrinho. Se não estiver definido ou não for um array, define como array vazio.
$carrinho = $CI->session->userdata('carrinho') ?? [];
if (!is_array($carrinho)) {
    $carrinho = [];
}
$total_itens = count($carrinho);
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="<?= site_url('produtos') ?>">Mini ERP</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Alternar navegação">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto align-items-center">
                <!-- Item do Carrinho -->
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="carrinhoDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="badge badge-pill badge-danger"><?= $total_itens ?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right p-3 shadow-sm" style="min-width: 300px;">
                        <?php if (empty($carrinho)): ?>
                            <span class="text-muted">Seu carrinho está vazio.</span>
                        <?php else: ?>
                            <?php foreach ($carrinho as $item): ?>
                                <?php
                                // Usa valores padrão caso alguma chave não esteja definida
                                $nome       = htmlspecialchars($item['nome'] ?? 'Sem Nome', ENT_QUOTES, 'UTF-8');
                                $variacao   = htmlspecialchars($item['variacao'] ?? '', ENT_QUOTES, 'UTF-8');
                                $quantidade = isset($item['quantidade']) ? (int)$item['quantidade'] : 0;
                                $preco      = isset($item['preco']) ? (float)$item['preco'] : 0;
                                ?>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div>
                                        <strong><?= $nome ?></strong><br>
                                        <small><?= $variacao ?></small>
                                    </div>
                                    <div class="text-right">
                                        <?= $quantidade ?>x<br>
                                        R$ <?= number_format($preco, 2, ',', '.') ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <div class="text-right mt-2">
                                <a href="<?= site_url('carrinho') ?>" class="btn btn-sm btn-primary">Ver Carrinho</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>