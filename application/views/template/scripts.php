<!-- Bootstrap core JavaScript
			================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>
<!--<script src="<?php echo base_url(); ?>public/js/owl.carousel.min.js"></script>-->
<!--<script src="<?php echo base_url(); ?>public/js/cbpAnimatedHeader.js"></script>-->
<!--<script src="<?php echo base_url(); ?>public/js/theme-scripts.js"></script>-->
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="<?php echo base_url(); ?>public/js/ie10-viewport-bug-workaround.js"></script>
<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="<?= base_url('public/js/bootstrap.min.js'); ?>"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>


<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<?php if (isset($scripts)) {
	foreach ($scripts as $script_name) {
		$src = base_url() . "public/js/" . $script_name; ?>
		<script src="<?= $src ?>"></script>
<?php }
} ?>
<script src="<?php echo base_url(); ?>public/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/bootstrap.bundle.min.js"></script>
<script>
	$(document).ready(function() {



		// Toggle do carrinho
		$('#carrinhoDropdown').on('click', function(e) {
			e.preventDefault();
			$(this).next('.dropdown-menu').toggle();
		});
		$(document).on('click', function(e) {
			if (!$(e.target).closest('#carrinhoDropdown, .dropdown-menu').length) {
				$('.dropdown-menu').hide();
			}
		});

		// Modal de confirmação de exclusão
		$('#modalConfirmarExclusao').on('show.bs.modal', function(event) {
			const button = $(event.relatedTarget);
			const id = button.data('id');
			const nome = button.data('nome');
			const tipo = button.data('tipo');
			$('#nomeItemModal').text(nome);
			let url = "";
			if (tipo === 'cupom') {
				url = "<?= site_url('cupons/delete/'); ?>" + id;
			} else if (tipo === 'produto') {
				url = "<?= site_url('produtos/delete/'); ?>" + id;
			}
			$('#btnConfirmarExclusao').attr('href', url);
		});

		// Toast de feedback (certifique-se de ter um .toast no HTML)
		// $('.toast').toast({ delay: 3000 }).toast('show');
	});
</script>
<script>
	$(document).ready(function() {

		// Toggle do dropdown do carrinho (se existir)
		$('#carrinhoDropdown').on('click', function(e) {
			e.preventDefault();
			$(this).next('.dropdown-menu').toggle();
		});
		$(document).on('click', function(e) {
			if (!$(e.target).closest('#carrinhoDropdown, .dropdown-menu').length) {
				$('.dropdown-menu').hide();
			}
		});

		// Modal de confirmação genérico: monta a mensagem e a URL de exclusão
		$('#modalConfirmarExclusao').on('show.bs.modal', function(event) {
			const button = $(event.relatedTarget);
			const id = button.data('id');
			const nome = button.data('nome');
			const tipo = button.data('tipo'); // 'produto' ou 'cupom'
			$('#nomeItemModal').text(nome);
			let url = "";
			if (tipo === 'cupom') {
				url = "<?= site_url('cupons/delete/'); ?>" + id;
			} else if (tipo === 'produto') {
				url = "<?= site_url('produtos/delete/'); ?>" + id;
			}
			$('#btnConfirmarExclusao').attr('href', url);
		});
	});
</script>