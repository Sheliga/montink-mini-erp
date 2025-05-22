<!DOCTYPE html>
<html>

<head>
    <title>Cupons</title>
    <link href="<?= base_url('public/css/bootstrap.min.css') ?>" rel="stylesheet">
</head>

<body class="p-4">
    <div class="container">
        <h1>Cupons</h1>
        <a href="<?= site_url('cupons/create') ?>" class="btn btn-primary mb-3">Novo Cupom</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Validade</th>
                    <th>Valor Mínimo</th>
                    <th>Desconto</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cupons as $cupom): ?>
                    <tr>
                        <td><?= $cupom->codigo ?></td>
                        <td><?= $cupom->validade ?></td>
                        <td>R$ <?= number_format($cupom->valor_minimo, 2, ',', '.') ?></td>
                        <td>R$ <?= number_format($cupom->desconto, 2, ',', '.') ?></td>
                        <td>
                            <a href="<?= site_url('cupons/edit/' . $cupom->id) ?>" class="btn btn-sm btn-warning">Editar</a>
                            <a href="<?= site_url('cupons/delete/' . $cupom->id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Excluir cupom?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</body>

</html>