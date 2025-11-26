<?php
session_start();
require_once "quiz_data.php";

if (!isset($_SESSION["current_question"])) {
    $_SESSION["current_question"] = 0;
    $_SESSION["answers"] = [];
}

$current = $_SESSION["current_question"];
$total = count($quiz);

// Quiz finito → mostro risultato
if ($current >= $total) {
    $score = 0;
    foreach ($_SESSION["answers"] as $i => $answer) {
        if ($quiz[$i]["correct"] == $answer) {
            $score++;
        }
    }
?>

    <!-- HTML del risultato -->
    <!DOCTYPE html>
    <html lang="eng">

    <head>
        <meta charset="UTF-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <title>Risultato Quiz</title>
    </head>

    <body>

        <nav class="navbar navbar-dark bg-dark">
            <div class="container">
                <span class="navbar-brand">Quiz Storico</span>
            </div>
        </nav>

        <div class="container mt-5">
            <div class="card shadow p-4 text-center">
                <h2 class="mb-3">Risultato finale</h2>
                <h4 class="display-5"><?= $score ?> / <?= $total ?></h4>

                <?php foreach ($_SESSION["answers"] as $i => $answer):
                    $correct = $quiz[$i]["correct"];
                    $isCorrect = ($correct == $answer);
                ?>
                    <div class="p-3 my-3 mb-3 rounded <?= $isCorrect ? 'border border-success' : 'border border-danger' ?>">

                        <h5 class="<?= $isCorrect ? 'text-success' : 'text-danger' ?>"><?= $quiz[$i]["domanda"] ?></h5>
                        <p><strong>Tua risposta:</strong> <?= $quiz[$i]["opzioni"][$answer] ?></p>

                        <?php if (!$isCorrect): ?>
                            <p><strong>Risposta corretta:</strong> <?= $quiz[$i]["opzioni"][$correct] ?></p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>

                <a href="reset.php" class="btn btn-primary btn-lg mt-4">Ricomincia il quiz</a>
            </div>
        </div>

    </body>

    </html>

<?php
    exit;
}

$domanda = $quiz[$current]["domanda"];
$opzioni = $quiz[$current]["opzioni"];
?>

<!-- HTML delle domande -->
<!DOCTYPE html>
<html lang="eng">

<head>
    <meta charset="UTF-8">
    <title>Quiz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

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
                <?php 
                $saved = $_SESSION["answers"][$current] ?? null;
                foreach ($opzioni as $idx => $opzione): ?>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="answer" id="opt<?= $idx ?>" value="<?= $idx ?>" <?= ($saved === $idx) ? "checked" : "" ?>>
                        <label class="form-check-label" for="opt<?= $idx ?>">
                            <?= $opzione ?>
                        </label>
                    </div>
                <?php endforeach; ?>

                <div class="d-flex justify-content-between mt-3">
                    <button type="submit" name="action" value="prev" class="btn btn-secondary mt-3 ms-2">Torna indietro</button>
                    <button type="submit" name="action" value="next" class="btn btn-primary mt-3">Invia risposta</button>
                </div>
            </form>

        </div>
    </div>

    <script>
        //Mi assicuro che venga selezionata una risposta
        document.querySelector('button[value="next"]').addEventListener('click', function(e) {
            const radios = document.querySelectorAll('input[name="answer"]');
            let checked = false;
            radios.forEach(r => {
                if (r.checked) checked = true;
            });

            if (!checked) {
                e.preventDefault();
                alert("Seleziona una risposta per continuare.");
            }
        });
    </script>
</body>

</html>