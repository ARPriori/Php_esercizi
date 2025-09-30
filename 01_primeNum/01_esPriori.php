<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./myStyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body class="montserrat">
    <h1 class="header mt-5 ms-2">Primi Cento Numeri Primi</h1>

    <ul class="list-group list-group-flush">
        <?php

        //Controlla se un numero è primo
        function isPrime($num)
        {
            if ($num <= 1)
                return false;
            for ($i = 2; $i <= sqrt($num); $i++) {
                if ($num % $i == 0)
                    return false; // Se è divisibile per un numero diverso da 1 e sé stesso, non è primo
            }
            return true;
        }

        $primes = [];
        $num = 2;

        //Fino a quando non ho registrato cento numeri primi
        while (count($primes) < 100) {
            if (isPrime($num)) {
                $primes[] = $num;
            }
            $num++;
        }

        //Aggiungo un elemento della lista per ogni numero
        foreach ($primes as $p) {
            echo '<li class="list-group-item">' . $p . '</li>';
        }

        ?>
    </ul>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>