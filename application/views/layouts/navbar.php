<?php
// Obter a instância do CI para acesso à sessão
$CI = &get_instance();
$carrinho = $CI->session->userdata('carrinho') ?? [];
if (!is_array($carrinho)) {
    $carrinho = [];
}
$total_itens = count($carrinho);
?>

<header>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top shadow-sm bg-dark bg-opacity-75">
        <div class="container">
            <a class="navbar-brand" href="<?= site_url('produtos') ?>">Mini ERP</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse"
                data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Alternar navegação">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto align-items-center">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="carrinhoDropdown"
                            role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-shopping-cart mr-1"></i>
                            <span class="badge badge-pill badge-danger"><?= $total_itens ?></span>
                            <span class="ml-2 d-none d-md-inline">Carrinho</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow-sm" aria-labelledby="carrinhoDropdown"
                            style="min-width: 320px;">
                            <?php if (empty($carrinho)): ?>
                                <p class="text-center text-muted mb-0">Seu carrinho está vazio.</p>
                            <?php else: ?>
                                <?php foreach ($carrinho as $item): ?>
                                    <?php
                                    $nome       = htmlspecialchars($item['nome'] ?? 'Sem Nome', ENT_QUOTES, 'UTF-8');
                                    $variacao   = htmlspecialchars($item['variacao'] ?? '', ENT_QUOTES, 'UTF-8');
                                    $quantidade = (int)($item['quantidade'] ?? 0);
                                    $preco      = (float)($item['preco'] ?? 0);
                                    ?>
                                    <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                                        <div class="flex-grow-1">
                                            <strong><?= $nome ?></strong><br>
                                            <small class="text-muted"><?= $variacao ?></small>
                                        </div>
                                        <div class="text-right ml-3">
                                            <span class="badge badge-light"><?= $quantidade ?>x</span><br>
                                            <small class="text-success">R$ <?= number_format($preco, 2, ',', '.') ?></small>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                <div class="text-right mt-3">
                                    <a href="<?= site_url('carrinho') ?>" class="btn btn-sm btn-primary btn-block">Ver Carrinho</a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


</header>