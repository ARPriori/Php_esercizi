<?php
session_start();

if (!isset($_SESSION["cameriere"])) {
    header("Location: login.php");
    exit;
}

$cameriere = $_SESSION["cameriere"];


if (!isset($_SESSION["tavoli"])) {
    $_SESSION["tavoli"] = [];
}

//Aggiunta tavolo nuovo
if (isset($_POST["nuovo_tavolo"])) {
    $numero = $_POST["nuovo_tavolo"];
    if (!isset($_SESSION["tavoli"][$numero])) {
        $_SESSION["tavoli"][$numero] = ["comande" => []];
    }
}

//Aggiunta piatto a tavolo
if (isset($_POST["tavolo"]) && isset($_POST["piatto"])) {
    $tav = $_POST["tavolo"];
    $piatto = trim($_POST["piatto"]);
    if ($piatto !== "" && isset($_SESSION["tavoli"][$tav])) {
        $_SESSION["tavoli"][$tav]["comande"][] = $piatto;
    }
}

//Termina tavolo
if (isset($_POST["chiudi_tavolo"])) {
    $tav = $_POST["chiudi_tavolo"];
    unset($_SESSION["tavoli"][$tav]);
}
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
        <h2 class="text-center mb-4">Benvenuto <?= $cameriere ?>!</h2>

        <div class="mb-4 m-auto w-50">
            <form method="post" class="d-flex gap-2">
                <input type="number" class="form-control" name="nuovo_tavolo" placeholder="Numero tavolo" required>
                <button class="btn btn-light" type="submit">Aggiungi Tavolo</button>
            </form>
        </div>

        <!-- TAVOLI -->
        <div class="row">
            <?php if (empty($_SESSION["tavoli"])): ?>
                <p class="text-center text-muted">Nessun tavolo attivo.</p>
            <?php else: ?>
                <?php foreach ($_SESSION["tavoli"] as $numero => $info): ?>
                    <div class="col-md-4 mb-3">
                        <div class="card p-3">

                            <!-- numero tavolo -->
                            <h5 class="card-title">Tavolo <?= htmlspecialchars($numero) ?></h5>

                            <!-- lista comande -->
                            <ul class="list-group mb-3">
                                <?php if (empty($info["comande"])): ?>
                                    <li class="list-group-item text-muted">Nessuna comanda.</li>
                                <?php else: ?>
                                    <?php foreach ($info["comande"] as $piatto): ?>
                                        <li class="list-group-item"><?= htmlspecialchars($piatto) ?></li>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </ul>

                            <!-- form aggiunta comanda -->
                            <form method="post" class="d-flex gap-2">
                                <input type="hidden" name="tavolo" value="<?= $numero ?>">
                                <input type="text" name="piatto" class="form-control" placeholder="Aggiungi piatto">
                                <button class="btn btn-light">+</button>
                            </form>

                            <!-- form per chiudere tavolo (caso: servizio concluso) -->
                            <form method="post" class="mt-2">
                                <button name="chiudi_tavolo" value="<?= $numero ?>" class="btn btn-warning w-100">
                                    Chiudi Tavolo
                                </button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="my-5 text-center m-auto">
            <a href="logout.php" class="btn btn-danger">Termina turno</a>
        </div>
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>