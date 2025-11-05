<?php
session_start();

$prodotti = [
    1 => ["nome" => "Maglietta", "prezzo" => 15.00],
    2 => ["nome" => "Pantaloni", "prezzo" => 30.00],
    3 => ["nome" => "Scarpe", "prezzo" => 45.00],
    4 => ["nome" => "Cappello", "prezzo" => 10.00],
];

// Svuota carrello
if (isset($_GET["svuota"])) {
    session_destroy();
    header("Location: carrello.php");
    exit;
}

// Aggiorna quantità
if (isset($_POST["quantità"])) {
    foreach ($_POST["quantità"] as $id => $qta) {
        $qta = max(0, intval($qta));
        if ($qta == 0) {
            unset($_SESSION["carrello"][$id]);
        } else {
            $_SESSION["carrello"][$id] = $qta;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="eng">

<head>
    <meta charset="UTF-8">
    <title>Carrello</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        body {
            background-color: #f4f6fa;
        }

        .navbar,
        .btn-primary {
            background-color: #5A6E8C !important;
        }

        .btn-primary:hover {
            background-color: #4b5d77 !important;
        }

        h1 {
            color: #4b5d77;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-dark mb-4">
        <div class="container">
            <a href="prodotti.php" class="btn btn-light">⬅ Prodotti</a>
            <span class="navbar-brand mb-0 h1">Carrello</span>
        </div>
    </nav>

    <div class="container">
        <h1 class="text-center mb-4">Il tuo carrello</h1>

        <?php if (!empty($_SESSION["carrello"])): ?>
            <form method="post">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle shadow-sm">
                        <thead class="table-light">
                            <tr>
                                <th>Nome</th>
                                <th>Prezzo unitario (€)</th>
                                <th>Quantità</th>
                                <th>Totale (€)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $totale = 0;
                            foreach ($_SESSION["carrello"] as $id => $qta):
                                $nome = $prodotti[$id]["nome"];
                                $prezzo = $prodotti[$id]["prezzo"];
                                $subtotale = $prezzo * $qta;
                                $totale += $subtotale;
                                ?>
                                <tr>
                                    <td><?= $nome ?></td>
                                    <td><?= number_format($prezzo, 2) ?></td>
                                    <td>
                                        <input type="number" name="quantità[<?= $id ?>]" value="<?= $qta ?>" min="0"
                                            class="form-control" style="width:80px;">
                                    </td>
                                    <td><?= number_format($subtotale, 2) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="text-primary">Totale: € <?= number_format($totale, 2) ?></h4>
                    <div>
                        <button type="submit" class="btn btn-success me-2">Aggiorna quantità</button>
                        <a href="carrello.php?svuota=1" class="btn btn-danger"
                            onclick="return confirm('Sicuro di voler svuotare il carrello?')">🗑 Svuota carrello</a>
                        <a href="checkout.php" class="btn btn-primary">➡ Checkout</a>
                    </div>
                </div>
            </form>
        <?php else: ?>
            <div class="alert alert-info text-center">
                Il carrello è vuoto.
            </div>
            <div class="text-center">
                <a href="prodotti.php" class="btn btn-primary">Torna ai prodotti</a>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>