<?php
session_start();
require_once "quiz_data.php";

// Inizializza sessione
if(!isset($_SESSION["current_question"])){
    $_SESSION["current_question"] = 0;
    $_SESSION["answers"] = [];
}

$current = $_SESSION["current_question"];
$total = count($quiz);

// Se il quiz è finito → mostra risultato
if($current >= $total){
    $score = 0;
    foreach($_SESSION["answers"] as $i => $answer){
        if($quiz[$i]["correct"] == $answer){
            $score++;
        }
    }
    ?>

    <!DOCTYPE html>
    <html lang="it">
    <head>
        <meta charset="UTF-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <title>Risultato Quiz</title>
    </head>
    <body class="bg-light">

        <nav class="navbar navbar-dark bg-dark">
            <div class="container">
                <span class="navbar-brand">Quiz Storico</span>
            </div>
        </nav>

        <div class="container mt-5">
            <div class="card shadow p-4 text-center">
                <h2 class="mb-3">Risultato finale</h2>
                <h4 class="display-5"><?= $score ?> / <?= $total ?></h4>

                <a href="reset.php" class="btn btn-primary btn-lg mt-4">Ricomincia il quiz</a>
            </div>
        </div>

    </body>
    </html>

<?php
    exit;
}

// Domanda corrente
$domanda = $quiz[$current]["domanda"];
$opzioni = $quiz[$current]["opzioni"];
?>

<!DOCTYPE html>
<html lang="eng">
<head>
    <meta charset="UTF-8">
    <title>Quiz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <span class="navbar-brand">Quiz Storico</span>
    </div>
</nav>

<div class="container mt-5">

    <div class="card shadow p-4">
        <h4 class="mb-4">
            Domanda <?= $current + 1 ?> di <?= $total ?>
        </h4>

        <h5 class="mb-3"><?= $domanda ?></h5>

        <form action="process_answer.php" method="POST">
            <?php foreach ($opzioni as $idx => $opzione): ?>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="answer" id="opt<?= $idx ?>" value="<?= $idx ?>" required>
                    <label class="form-check-label" for="opt<?= $idx ?>">
                        <?= $opzione ?>
                    </label>
                </div>
            <?php endforeach; ?>

            <button type="submit" class="btn btn-primary mt-3">Invia risposta</button>
        </form>

    </div>
</div>

</body>
</html>
