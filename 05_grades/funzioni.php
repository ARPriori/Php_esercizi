<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>

    <?php
    $average = 0;

    function average($grades)
    {
        $sum = 0;

        foreach ($grades as $g) {
            $sum += $g;
        }

        $GLOBALS['average'] = $sum / (sizeof($grades));

        return $GLOBALS['average'];
    }

    function printFinalOutcome()
    {
        return "<span class=\"fw-bold\">" . (($GLOBALS['average'] >= 6) ? "PROMOSSO" : "BOCCIATO") . "</span>";
    }

    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>