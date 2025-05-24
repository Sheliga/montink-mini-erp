<!-- Modal Genérico de Confirmação -->
<div class="modal fade" id="modalConfirmarExclusao" tabindex="-1" aria-labelledby="modalConfirmarExclusaoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Confirmar Exclusão</h5>
                <button type="button" class="close btn-close-white" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Tem certeza que deseja excluir <strong id="nomeItemModal"></strong>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <a href="#" id="btnConfirmarExclusao" class="btn btn-danger">Excluir</a>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="<?= base_url('public/js/bootstrap.min.js'); ?>"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>


<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
<script>
    $(document).ready(function() {
        // Inicializa os DataTables se as tabelas existirem
        if ($('#produtosTable').length) {
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
        }
        if ($('#cuponsTable').length) {
            $('#cuponsTable').DataTable({
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
        }

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
</body>

</html>