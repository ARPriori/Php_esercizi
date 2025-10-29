<?php
session_start();

if (empty($_SESSION["carrello"])) {
    header("Location: prodotti.php");
    exit;
}

$prodotti = [
    1 => ["nome" => "Maglietta", "prezzo" => 15.00],
    2 => ["nome" => "Pantaloni", "prezzo" => 30.00],
    3 => ["nome" => "Scarpe", "prezzo" => 45.00],
    4 => ["nome" => "Cappello", "prezzo" => 10.00],
];

$totale = 0;
foreach ($_SESSION["carrello"] as $id => $qta) {
    $totale += $prodotti[$id]["prezzo"] * $qta;
}

if (isset($_POST["conferma"])) {
    session_destroy();
    echo '<!DOCTYPE html><html><head><meta charset="UTF-8"><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"><style>body{background-color:#f4f6fa;}</style></head><body>';
    echo '<div class="container text-center mt-5">';
    echo '<div class="alert alert-success shadow-sm"><h1>✅ Ordine confermato!</h1><p>Grazie per il tuo acquisto.</p></div>';
    echo '<a href="prodotti.php" class="btn btn-primary">Torna ai prodotti</a></div></body></html>';
    exit;
}
?>

<!DOCTYPE html>
<html lang="eng">

<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6fa;
        }

        .navbar,
        .btn-primary {
            background-color: #5A6E8C !important;
        }

        h1 {
            color: #4b5d77;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-dark mb-4">
        <div class="container">
            <a href="carrello.php" class="btn btn-light">Torna al Carrello</a>
            <span class="navbar-brand mb-0 h1">Checkout</span>
        </div>
    </nav>

    <div class="container text-center">
        <h1 class="mb-4">Riepilogo ordine</h1>
        <p class="fs-4">Totale da pagare: <strong>€ <?= number_format($totale, 2) ?></strong></p>

        <form method="post">
            <button type="submit" name="conferma" class="btn btn-primary btn-lg">Conferma ordine</button>
        </form>
    </div>

</body>

</html>