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

    $errore = false;
    $messaggioErrore = "";

    if (empty($courses)) {
        $errore = true;
        $messaggioErrore = "Errore: non è stato selezionato alcun pasto.";
    } elseif ($haAppetizer && !$haFirst && !$haSecond) {
        $errore = true;
        $messaggioErrore = "Non è possibile ordinare solo l'antipasto.";
    }

    //Calcolo il prezzo totale delle portate selezionate
    foreach ($courses as $course) {
        if (isset($prezzi[$course])) {
            $totalPrice += $prices[$course];
        }
    }

    // Calcolo sconti
    $sconto = 0;
    if ($haFirst && $haSecond && !$haAppetizer) {
        $sconto = 0.10;
    } elseif ($haAppetizer && $haFirst && $haSecond) {
        $sconto = 0.15;
    }

    $prezzoScontato = $prezzoParziale - ($prezzoParziale * $sconto);

    // Prezzo parcheggio
    $prezzoParcheggio = 0;
    switch ($parking) {
        case "uncontrolled":
            $prezzoParcheggio = 3;
            break;
        case "controlled":
            $prezzoParcheggio = 5;
            break;
        default:
            $prezzoParcheggio = 0;
            break;
    }

    // Prezzo totale
    $prezzoTotale = $prezzoScontato + $prezzoParcheggio;

    ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>