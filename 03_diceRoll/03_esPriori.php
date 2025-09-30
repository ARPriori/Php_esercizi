<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="myStyle.css">
    <title>Dadi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body class="quicksand" data-bs-theme="dark">
    <?php
    $d1 = rand(1, 6);
    $d2 = rand(1, 6);

    // Funzione per restituire SVG del dado in base al valore
    function drawDice($value)
    {
        $dots = [
            1 => [[50, 50]],
            2 => [[25, 25], [75, 75]],
            3 => [[25, 25], [50, 50], [75, 75]],
            4 => [[25, 25], [25, 75], [75, 25], [75, 75]],
            5 => [[25, 25], [25, 75], [50, 50], [75, 25], [75, 75]],
            6 => [[25, 25], [25, 50], [25, 75], [75, 25], [75, 50], [75, 75]],
        ];

        //Creo un elemento svg 100*100 e dentro creo un quadrato (rect) delle stesse dimensioni con angoli arrotondati, sfondo bianco e brdo nero
        $svg = '<svg style="width: 100px; height: 100px;" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">';
        $svg .= '<rect width="100" height="100" rx="15" ry="15" fill="#fff" stroke="#416b43" stroke-width="5" />';

        //(in base al valore del dado) Per ogni coppia di coordinate crea un cerchio
        foreach ($dots[$value] as [$cx, $cy]) {
            $svg .= "<circle cx=\"$cx\" cy=\"$cy\" r=\"8\" fill=\"#416b43\" />";
        }

        $svg .= '</svg>';
        return $svg;
    }
    ?>

    <h1 class="text-center mt-5 title">Lancio dei Dadi</h1>

    <div class="d-flex justify-content-center gap-3 mt-5">
        <?= drawDice($d1) ?>
        <?= drawDice($d2) ?>
    </div>

    <div class="text-center text-light mt-4">
        <p>La somma dei dadi è: <strong><?php echo $d1 + $d2 ?></strong></p>
    </div>

    <form action="" class="text-center">
        <button type="submit" class="btn btn-outline-light mt-3">ROLL</button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>