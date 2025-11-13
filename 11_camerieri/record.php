<?php
session_start();

if (!isset($_SESSION["cameriere"])) {
    header("Location: login.php");
    exit;
}

$cameriere = $_SESSION["cameriere"];

// === MENU PREDEFINITO ===
$menu = [
    "Pasta alla Carbonara" => 10.00,
    "Tagliata di Manzo" => 15.30,
    "Insalata Caprese" => 6.00,
    "Pizza Margherita" => 5.50,
    "Tiramisù" => 1.50,
    "Acqua / Bevande" => 1.00,
];

// === FILE DATI TAVOLI ===
$file_data = __DIR__ . "/table_data.json";
if (!file_exists($file_data)) { // se non esiste il file
    file_put_contents($file_data, json_encode([], JSON_PRETTY_PRINT));
}
//copio in un array associativo gli elementi del file
$data = json_decode(file_get_contents($file_data), true);

// inizializza se non esiste la sezione del cameriere
if (!isset($data[$cameriere])) {
    $data[$cameriere] = [];
}

if (!isset($_SESSION["tavoli"])) {
    $_SESSION["tavoli"] = [];
}

// === AGGIUNTA TAVOLO ===
if (isset($_POST["nuovo_tavolo"])) {
    $numero_tav = $_POST["nuovo_tavolo"];
    if ($numero_tav !== "") { //se numero è valido
        $occupato = false;

        foreach ($data as $cam => $tavoli) { //controllo che non sia già assegnato a un altro cameriere
            if (isset($tavoli[$numero_tav]) && $cam !== $cameriere) {
                $occupato = true;
                break;
            }
        }

        if (!$occupato && !isset($data[$cameriere][$numero_tav])) {
            $data[$cameriere][$numero_tav] = ["comande" => []];
        } else {
            $errore = "Tavolo già assegnato";
        }
    }

}

// === MODIFICA QUANTITÀ PIATTI ===
if (isset($_POST["aggiorna_menu"]) && isset($_POST["tavolo"])) {
    $tav = $_POST["tavolo"];
    if (isset($data[$cameriere][$tav])) {
        foreach ($menu as $nome => $prezzo) {
            $qta = intval($_POST["quantità"][$nome] ?? 0);
            if ($qta > 0) {
                $data[$cameriere][$tav]["comande"][$nome] = $qta;
            } else {
                unset($data[$cameriere][$tav]["comande"][$nome]);
            }
        }
    }
}

// === CHIUSURA TAVOLO ===
if (isset($_POST["chiudi_tavolo"])) {
    $tav = $_POST["chiudi_tavolo"];
    unset($data[$cameriere][$tav]);
}

// === SALVA SU FILE ===
file_put_contents($file_data, json_encode($data, JSON_PRETTY_PRINT));

?>

<!DOCTYPE html>
<html lang="eng">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestione Tavoli</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body data-bs-theme="dark" class="p-4">

    <div class="container">
        <h2 class="text-center mb-4">Benvenuto <?= htmlspecialchars($cameriere) ?>!</h2>

        <?php if (isset($errore)): ?>
            <div class="alert alert-danger text-center"><?= htmlspecialchars($errore) ?></div>
        <?php endif; ?>

        <!-- AGGIUNTA TAVOLO -->
        <div class="mb-4 m-auto w-50">
            <form method="post" class="d-flex gap-2">
                <input type="number" class="form-control" name="nuovo_tavolo" placeholder="Numero tavolo" required>
                <button class="btn btn-light" type="submit">Aggiungi Tavolo</button>
            </form>
        </div>

        <!-- LISTA TAVOLI -->
        <div class="row">
            <?php if (empty($data[$cameriere])): ?>
                <p class="text-center text-muted">Nessun tavolo attivo.</p>
            <?php else: ?>
                <?php foreach ($data[$cameriere] as $numero => $info): ?>
                    <?php
                    $comande = $info["comande"];
                    $totale = 0;
                    foreach ($comande as $nome => $qta) {
                        $totale += $menu[$nome] * $qta;
                    }
                    ?>
                    <div class="col-md-4 mb-3">
                        <div class="card p-3 shadow-sm">
                            <h5 class="card-title">Tavolo <?= htmlspecialchars($numero) ?></h5>

                            <!-- menù -->
                            <form method="post">
                                <input type="hidden" name="tavolo" value="<?= htmlspecialchars($numero) ?>">
                                <table class="table table-sm table-bordered text-center align-middle">
                                    <thead class="table-secondary">
                                        <tr>
                                            <th>Piatto</th>
                                            <th>Prezzo</th>
                                            <th>Q.tà</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($menu as $nome => $prezzo):
                                            $qta = $comande[$nome] ?? 0;
                                            ?>
                                            <tr>
                                                <td><?= htmlspecialchars($nome) ?></td>
                                                <td><?= number_format($prezzo, 2) ?> €</td>
                                                <td>
                                                    <div class="input-group input-group-sm">
                                                        <button type="button" class="btn btn-outline-light"
                                                            onclick="var x=this.nextElementSibling; if(x.value>0)x.value--;"><?= "−" ?></button>
                                                        <input type="number" name="quantità[<?= htmlspecialchars($nome) ?>]"
                                                            value="<?= $qta ?>" min="0" class="form-control text-center"
                                                            style="width:50px;">
                                                        <button type="button" class="btn btn-outline-light"
                                                            onclick="var x=this.previousElementSibling; x.value++;"><?= "+" ?></button>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>

                                <button type="submit" name="aggiorna_menu" value="1" class="btn btn-success w-100">Aggiorna Comande</button>
                            </form>

                            <div class="mt-3">
                                <!-- stampa totale -->
                                <h6>Totale: € <?= number_format($totale, 2) ?></h6>
                                <!-- chiusura tavolo -->
                                <form method="post">
                                    <button name="chiudi_tavolo" value="<?= htmlspecialchars($numero) ?>"
                                        class="btn btn-warning w-100 mt-2">
                                        Chiudi Tavolo
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- LOGOUT -->
        <div class="my-5 text-center m-auto">
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>