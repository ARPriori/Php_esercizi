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
    function printGrades($grades)
    {
        $str = "<ul>";
        foreach ($grades as $g) {
            $str .= "<li>$g</li>";
        }
        $str .= "</ul>";

        return $str;
    }

    $grades = [];

    for ($i = 0; $i < 10; $i++) {
        $randG = rand(1, 10);
        $grades[] = $randG;
    }

    include_once 'funzioni.php';

    echo "<p>I voti dello studente sono:</p>" . printGrades($grades);
    echo "<p>La media dello studente è " . average($grades) . ". Lo studente è " . printFinalOutcome() . "</p>";
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>