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
    $str = "Nulla eget odio commodo, finibus diam eget, porta velit. Donec gravida, lectus ac auctor euismod, sapien nunc ultrices purus, nec ultricies purus nibh a turpis. Nam cursus sit amet neque nec ultricies. Nulla varius enim vitae ligula venenatis, eget sagittis ipsum viverra. Vestibulum id finibus orci. Nam porta convallis metus nec pellentesque. Donec commodo purus vel magna mattis malesuada.";
    $fontSize = rand(16, 40);
    echo "<p class=\"text-success\" style=\"font-size:" . rand(16, 40) . "px;\">$str</p>";
    echo "<p class=\"text-primary\" style=\"font-size:" . rand(16, 40) . "px;\">" . strtoupper($str) . "</p>";
    echo "<h1 class=\"text-danger\">" . strlen($str) . "</h1>";
    echo "<h2 class=\"text-warning\">" . str_word_count(strtoupper($str)) . "</h2>";
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>