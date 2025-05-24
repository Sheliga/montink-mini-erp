<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <!-- Meta tag viewport para mobile-first -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $title ?? 'Mini ERP' ?></title>

    <link href="<?= base_url(); ?>public/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        /* body {
            padding-top: 70px;
        } */

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