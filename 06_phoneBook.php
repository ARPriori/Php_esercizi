<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rubrica Telefonica</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');
    .montserrat{
        font-family: "Montserrat", sans-serif;
        font-optical-sizing: auto;
    }
    </style>
</head>
<body class="bg-light montserrat">

<div class="container my-5">
    <h1 class="mb-4 text-center">Rubrica Telefonica</h1>

    <?php
    function printPhoneBook($phoneBook, $title) {
        echo "<h3 class='mt-4'>$title</h3>";
        echo "<table class='table table-striped table-hover mt-3'>";
        echo "<thead class='table-success'><tr><th>Nome</th><th>Numero di telefono</th></tr></thead><tbody>";
        foreach ($phoneBook as $name => $number) {
            echo "<tr><td>$name</td><td>$number</td></tr>";
        }
        echo "</tbody></table>";
    }

    $phoneBook = array("Pietro Laio" => "3555621490", "Pino Lo" => "3006668080", "Anna Palindroma" => "324101423");

    printPhoneBook($phoneBook, "Rubrica iniziale");

    // Aggiunta, modifica e rimozione
    $phoneBook["Laura Neri"] = "3336669990";
    $phoneBook["Pietro Laio"] = "3308840512";
    unset($phoneBook["Pino Lo"]);

    printPhoneBook($phoneBook, "Rubrica aggiornata");
    ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>
</html>