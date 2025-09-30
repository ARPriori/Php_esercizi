<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body class="ms-4">
    <h1>Parole</h1>

    <form method="GET">
        <div class="mb-3  w-25">
            <label for="randWord" class="form-label">Parola</label>

            <div class="input-group mb-3">
                <input type="text" class="form-control" id="randWord" name="word" aria-describedby="button-addon2">
                <button type="submit" class="btn btn-outline-dark" id="button-addon2">invia</button>
            </div>
            <div id="emailHelp" class="form-text">Inserisci una parola per vedere se è palindroma e visualizzarla senza
                vocali</div>
        </div>
    </form>

    <div class="mt-5">
        <?php
        if (isset($_GET["word"])) {
            $str = $_GET["word"];
            echo ($str == strrev($str)) ? "<p>La parola $str è una parola palindroma</p>" : "<p>La parola $str non è una parola palindroma</p>";

            $strNoVoc = preg_replace('/[aeiouAEIOU]/', '', $str);
            echo "<p>La parola $str senza vocali è $strNoVoc</p>";
        }
        ?>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>