<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Produtos</title>

    <link href="<?= base_url(); ?>public/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        body {
            padding-top: 70px;
        }

        .badge-variacao {
            font-size: 0.9rem;
            margin: 2px 4px;
            padding: 0.5em 0.75em;
            font-weight: 500;
        }

        .table td,
        .table th {
            vertical-align: middle;
        }

        .dropdown-menu {
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>

    <?php
    $carrinho = $this->session->userdata('carrinho') ?? [];
    $total_itens = count($carrinho);
    ?>

    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="<?= site_url('produtos') ?>">Mini ERP</a>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link" id="carrinhoDropdown" role="button">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="badge badge-pill badge-danger"><?= $total_itens ?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right p-3 shadow-sm" style="min-width: 300px;">
                        <?php if (empty($carrinho)): ?>
                            <span class="text-muted">Seu carrinho está vazio.</span>
                        <?php else: ?>
                            <?php foreach ($carrinho as $item): ?>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div>
                                        <strong><?= htmlspecialchars($item['nome'], ENT_QUOTES, 'UTF-8') ?></strong><br>
                                        <small><?= htmlspecialchars($item['variacao'], ENT_QUOTES, 'UTF-8') ?></small>
                                    </div>
                                    <div>
                                        <?= $item['quantidade'] ?>x<br>
                                        R$ <?= number_format($item['preco'], 2, ',', '.') ?>
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
    </nav>

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
                                <span class="badge badge-<?=
                                                            $variacao->quantidade < 5 ? 'danger' : ($variacao->quantidade < 10 ? 'warning' : 'secondary') ?> badge-variacao">
                                    <?= $variacao->variacao ?> (<?= $variacao->quantidade ?>)
                                </span>
                            <?php endforeach; ?>
                        </td>
                        <td>
                            <?php foreach ($produto['variacoes'] as $variacao): ?>
                                <div class="d-flex flex-wrap mb-1">
                                    <a href="<?= site_url('estoques/editar/' . $variacao->estoque_id) ?>" class="btn btn-outline-warning btn-sm mr-1 mb-1" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="<?= site_url('estoques/excluir/' . $variacao->estoque_id) ?>" class="btn btn-outline-danger btn-sm mr-1 mb-1"
                                        onclick="return confirm('Tem certeza que deseja excluir a variação <?= $variacao->variacao ?>?')" title="Excluir">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                    <a href="<?= site_url('carrinho/adicionar/' . $variacao->estoque_id) ?>" class="btn btn-outline-success btn-sm mb-1" title="Adicionar ao Carrinho">
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

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="<?= base_url('public/js/bootstrap.min.js'); ?>"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#produtosTable').DataTable({
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json"
                },
                pageLength: 10,
                lengthMenu: [5, 10, 25, 50],
                order: [
                    [0, "asc"]
                ],
                responsive: true
            });

            // Dropdown do carrinho no clique
            $('#carrinhoDropdown').on('click', function(e) {
                e.preventDefault();
                $(this).next('.dropdown-menu').toggle();
            });

            $(document).on('click', function(e) {
                if (!$(e.target).closest('#carrinhoDropdown, .dropdown-menu').length) {
                    $('.dropdown-menu').hide();
                }
            });
        });
    </script>
</body>

</html>