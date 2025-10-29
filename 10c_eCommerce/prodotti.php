<?php
session_start();

$prodotti = [
    1 => ["nome" => "Maglietta", "prezzo" => 15.00],
    2 => ["nome" => "Pantaloni", "prezzo" => 30.00],
    3 => ["nome" => "Scarpe", "prezzo" => 45.00],
    4 => ["nome" => "Cappello", "prezzo" => 10.00],
];

// Gestione aggiunta al carrello
$messaggio = '0 prodotti nel carrello. Totale: € 0';
if (isset($_POST["id"])) {
    $id = intval($_POST["id"]);
    if (!isset($_SESSION["carrello"])) $_SESSION["carrello"] = [];
    $_SESSION["carrello"][$id] = ($_SESSION["carrello"][$id] ?? 0) + 1;

    // Calcola totale e quantità
    $totale = 0;
    $quantitàTotale = 0;
    foreach ($_SESSION["carrello"] as $pid => $qta) {
        $totale += $prodotti[$pid]["prezzo"] * $qta;
        $quantitàTotale += $qta;
    }
    $messaggio = "$quantitàTotale prodotti nel carrello. Totale: € " . number_format($totale,2);
}
?>

<!DOCTYPE html>
<html lang="eng">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Prodotti</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body { background-color: #f4f6fa; }
    .navbar, .btn-primary { background-color: #5A6E8C !important; }
    .btn-primary:hover { background-color: #4b5d77 !important; }
    h1 { color: #4b5d77; }
    .card { border-color: #cdd3df; }
</style>
</head>
<body>

<nav class="navbar navbar-dark mb-4">
  <div class="container">
    <span class="navbar-brand mb-0 h1">Mini E-commerce</span>
    <a href="carrello.php" class="btn btn-light">🛒 Carrello</a>
  </div>
</nav>

<div class="container">
    <h1 class="text-center mb-4">Catalogo Prodotti</h1>

    <?php if($messaggio): ?>
        <div class="text-center my-5">
            <?= $messaggio ?>
        </div>
    <?php endif; ?>

    <div class="row">
        <?php foreach ($prodotti as $id => $prodotto): ?>
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title"><?= htmlspecialchars($prodotto["nome"]) ?></h5>
                        <p class="card-text text-muted">€ <?= number_format($prodotto["prezzo"], 2) ?></p>
                        <form method="post">
                            <input type="hidden" name="id" value="<?= $id ?>">
                            <button type="submit" class="btn btn-primary">Aggiungi al carrello</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

</body>
</html>
