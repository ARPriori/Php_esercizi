<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');

        .montserrat {
            font-family: "Montserrat", sans-serif;
            font-optical-sizing: auto;
        }
    </style>
</head>

<body class="montserrat" data-bs-theme="dark">
    <?php
    $prices = ["appetizer" => 5, "first" => 6, "second" => 7];
    $totalPrice = 0;

    $waiters = ["Pino", "Maria", "Paola", "Simone", "Ester"];
    $assignedWaiter = $waiters[array_rand($waiters)];

    // Dati dal form
    $nome = $_POST["name"] ?? '';
    $cognome = $_POST["surname"] ?? '';
    $tavolo = $_POST["tableNum"] ?? '';
    $orario = $_POST["time"] ?? '';
    $note = $_POST["note"] ?? '';
    $courses = $_POST["courses"] ?? [];
    $parking = $_POST["parking"] ?? '';
    $dataPrenotazione = date("d-m-Y H:i");

    // Normalizza $courses a array anche se è uno solo (stringa)
    if (!is_array($courses)) {
        $courses = [$courses];
    }

    // Verifiche di errore
    $haAppetizer = in_array("appetizer", $courses);
    $haFirst = in_array("first", $courses);
    $haSecond = in_array("second", $courses);

    //Controllo errori
    $errore = false;
    $messaggioErrore = "";

    if (empty($courses)) {
        $errore = true;
        $messaggioErrore = "Errore: non è stato selezionato alcun pasto.";
    } elseif ($haAppetizer && !$haFirst && !$haSecond) {
        $errore = true;
        $messaggioErrore = "Non è possibile ordinare solo l'antipasto.";
    } elseif (empty($orario)) {
        $errore = true;
        $messaggioErrore = "Errore: l'orario non è stato selezionato.";
    } elseif (empty($nome) && empty($cognome)) {
        $errore = true;
        $messaggioErrore = "Errore: devi inserire almeno il nome o il cognome.";
    }


    //Calcolo il prezzo totale delle portate selezionate
    $partialPrice = 0;
    foreach ($courses as $course) {
        if (isset($prices[$course])) {
            $partialPrice += $prices[$course];
        }
    }

    // Calcolo sconti
    $discount = 0;
    if ($haFirst && $haSecond && !$haAppetizer) {
        $discount = 0.10;
    } elseif ($haAppetizer && $haFirst && $haSecond) {
        $discount = 0.15;
    }

    $dicountedPrice = $partialPrice - ($partialPrice * $discount);

    // Prezzo parcheggio
    $parkingPrice = 0;
    switch ($parking) {
        case "uncontrolled":
            $parkingPrice = 3;
            break;
        case "controlled":
            $parkingPrice = 5;
            break;
        default:
            $parkingPrice = 0;
            break;
    }

    // Prezzo totale
    $totalPrice = $dicountedPrice + $parkingPrice;

    ?>

    <div class="container mt-5">
        <?php if ($errore): ?>
            <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">Errore nella prenotazione</h4>
                <p><?= $messaggioErrore ?></p>
                <hr>
                <p class="mb-0">Data e ora della prenotazione: <strong><?= $dataPrenotazione ?></strong></p>
                <a href="prenotazione.html" class="btn btn-warning mt-3">Torna alla prenotazione</a>
            </div>
        <?php else: ?>
            <h2 class="mb-4">Riepilogo Prenotazione</h2>
            <table class="table table-bordered table-dark">
                <tbody>
                    <tr>
                        <th scope="row">Nome</th>
                        <td><?= htmlspecialchars($nome) ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Cognome</th>
                        <td><?= htmlspecialchars($cognome) ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Tavolo</th>
                        <td><?= htmlspecialchars($tavolo) ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Orario</th>
                        <td><?= htmlspecialchars($orario) ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Cameriere Assegnato</th>
                        <td><?= $assignedWaiter ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Portate</th>
                        <td><?= implode(", ", $courses) ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Note</th>
                        <td><?= nl2br(htmlspecialchars($note)) ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Parcheggio</th>
                        <td><?= $parking ?: 'Nessuno' ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Prezzo Totale</th>
                        <td>€ <?= number_format($totalPrice, 2, ',', '.') ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Data e Ora Prenotazione</th>
                        <td><?= $dataPrenotazione ?></td>
                    </tr>
                </tbody>
            </table>
        <?php endif; ?>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>