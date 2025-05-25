<div class="vertical-center-wrapper">


    <div class="container margin-around mt-5">
        <h2 class="mb-4">Finalizard Pedido</h2>

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

                <div class="form-group">
                    <label for="cep">CEP</label>
                    <input type="text" class="form-control" id="cep" name="cep" placeholder="00000-000" maxlength="9">
                    <div id="cepfeedback" class="text-danger d-none">CEP inválido. Corrija para continuar.</div>
                </div>

                <div class="form-group">
                    <label for="endereco">Endereço</label>
                    <input type="text" class="form-control" id="endereco" name="endereco">
                </div>

                <div class="form-group">
                    <label for="bairro">Bairro</label>
                    <input type="text" class="form-control" id="bairro" name="bairro">
                </div>

                <div class="form-group">
                    <label for="cidade">Cidade</label>
                    <input type="text" class="form-control" id="cidade" name="cidade">
                </div>

                <div class="form-group">
                    <label for="uf">Estado</label>
                    <input type="text" class="form-control" id="uf" name="uf">
                </div>
                <button type="submit" class="btn btn-success mt-4">Confirmar Pedido</button>

            </form>

            <a href="<?= site_url('carrinho') ?>" class="btn btn-secondary mt-3">Voltar ao Carrinho</a>
        <?php endif; ?>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        function limpaCamposEndereco() {
            $('#endereco, #bairro, #cidade, #uf').val('');
        }

        function mostrarErroCep(mostrar) {
            if (mostrar) {
                $('#cep').addClass('is-invalid');
                $('#cepfeedback').removeClass('d-none');
            } else {
                $('#cep').removeClass('is-invalid');
                $('#cepfeedback').addClass('d-none');
            }
        }

        $('#cep').on('input', function() {
            let cep = $(this).val().replace(/\D/g, '');

            // Formatar como 00000-000
            if (cep.length > 5) {
                cep = cep.replace(/^(\d{5})(\d{0,3})/, '$1-$2');
            }

            $(this).val(cep);
            mostrarErroCep(false); // Oculta o erro ao digitar
        });

        $('#cep').on('blur', function() {
            let cep = $(this).val().replace(/\D/g, '');

            if (cep.length !== 8) {
                mostrarErroCep(true);
                limpaCamposEndereco();
                return;
            }

            $.getJSON(`https://viacep.com.br/ws/${cep}/json/`, function(data) {
                if (data.erro) {
                    mostrarErroCep(true);
                    limpaCamposEndereco();
                } else {
                    mostrarErroCep(false);
                    $('#endereco').val(data.logradouro);
                    $('#bairro').val(data.bairro);
                    $('#cidade').val(data.localidade);
                    $('#uf').val(data.uf);
                }
            }).fail(function() {
                mostrarErroCep(true);
                limpaCamposEndereco();
            });
        });
    });
</script>

</script>