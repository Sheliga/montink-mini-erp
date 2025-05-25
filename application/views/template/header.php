<!DOCTYPE html>
<html lang="pt-BR">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Mini ERP</title>
	<link rel="icon" href="favicon.ico">
	<link href="<?= base_url(); ?>public/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

	<!-- Bootstrap CSS -->
	<link href="<?php echo base_url(); ?>public/css/bootstrap.min.css" rel="stylesheet">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<!-- Custom CSS -->
	<link href="<?php echo base_url(); ?>public/css/owl.carousel.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>public/css/owl.theme.default.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>public/css/style.css" rel="stylesheet">



	<!-- Estilos adicionais -->
	<style>
		body,
		html {
			height: 100%;
			margin: 0;
		}

		/* Modo Escuro */
		body.dark-mode {
			background-color: #121212;
			color: #ffffff;
		}

		body,
		html {
			height: 100%;
			margin: 0;
		}

		.vertical-center-wrapper {
			min-height: 100vh;
			/* ocupa a tela toda */
			display: flex;
			align-items: center;
			/* centraliza verticalmente */
			justify-content: center;


		}

		.vertical-center-wrapper .margin-around {
			margin: 7rem;
		}

		.navbar-nav {
			list-style: none;
		}

		.navbar-nav li {
			margin-right: 1rem;
		}

		/* Estilização do menu suspenso do carrinho */
		.dropdown-menu {
			z-index: 1050;
			transition: opacity 0.3s ease, transform 0.3s ease;
		}

		/* Toast de confirmação */
		.toast-container {
			position: fixed;
			top: 1rem;
			right: 1rem;
			z-index: 1060;
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

		.d-none {
			display: none;
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

<body id="page-top">
	<?php
	// Obter a instância do CI para acesso à sessão
	$CI = &get_instance();
	$carrinho = $CI->session->userdata('carrinho') ?? [];
	if (!is_array($carrinho)) {
		$carrinho = [];
	}
	$total_itens = count($carrinho);
	?>



	<nav class="navbar navbar-default navbar-shrink navbar-fixed-top list-unstyled">

		<div class="container">
			<a class="navbar-brand" href="<?php echo base_url(); ?>">Mini ERP</a>
			<!-- <button class="navbar-toggler" type="button" data-toggle="collapse"
				data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
				aria-label="Alternar navegação">
				<span class="navbar-toggler-icon"></span>
			</button> -->

			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav  navbar-right align-items-center">
					<li class="nav-item mx-3 p-2">
						<a class="nav-link" href="<?php echo base_url(); ?>pedidos">Pedidos</a>
					</li>
					<li class="nav-item mx-3 p-2">
						<a class="nav-link" href="<?php echo base_url(); ?>produtos">Produtos</a>
					</li>
					<li class="nav-item mx-3">
						<a href="<?php echo base_url(); ?>cupons">Cupons</a>
					</li>
					<!-- Carrinho -->
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="carrinhoDropdown"
							role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fa fa-shopping-cart mr-1"></i>
							<span class="badge badge-pill badge-danger"><?= $total_itens ?></span>
							<span class="ml-2 d-none d-md-inline">Carrinho</span>
						</a>
						<div class="dropdown-menu dropdown-menu-right p-3 shadow" aria-labelledby="carrinhoDropdown"
							style="min-width: 320px; z-index: 1050;">
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
									<a href="<?php echo base_url(); ?>carrinho" class="btn btn-sm btn-primary btn-block">Ver Carrinho</a>
								</div>
							<?php endif; ?>
						</div>
					</li>
					<!-- <li class="nav-item">
						<a class="nav-link" href="<?php echo base_url(); ?>restrict">Login</a>
					</li> -->

				</ul>
			</div>
		</div>
	</nav>