<?php
session_start();

$cameriere = $_SESSION["cameriere"];

$tavoli = [];
for ($i = 0; $i < 10; $i++) {
    $tavoli[$i] = true; //false --> tavolo non occupato, true --> tavolo occupato
}

//array di tavoli che sto servendo
//array che associa tavoli alle comande

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Record</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body class="text-center" data-bs-theme="dark">
    <h1>Benvenuto <?= $cameriere ?>!</h1>

    <form>
            <div class="mb-3">
                <label for="select" class="form-label">Aggiungi Tavolo</label>
                <select id="select" class="form-select">
                    <option>Tavolo 1</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>