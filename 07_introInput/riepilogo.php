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
    <div class="w-50 m-auto mt-4">
        <?php
        $name = $_GET["name"];
        $surname = $_GET["surname"];
        $email = $_GET["email"];

        echo "<h1>Dati Inviati:</h1>";
        echo "<table class='table table-striped-columns mt-3'><thead class='table-light'><tr><th>Name</th><th>Surname</th><th>Email Address</th></tr></thead><tbody>";
        echo "<tr><td>$name</td><td>$surname</td><td>$email</td></tr>";
        echo "</tbody></table>";
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>