<?php
session_start();

if (!isset($_SESSION['form_anagrafici']) || !isset($_SESSION['form_contatto'])) {
    header("Location: step1.php");
    exit;
}

function label($key)
{
    return ucwords(str_replace("_", " ", $key));
}
?>
<!DOCTYPE html>
<html lang="eng">

<head>
    <meta charset="UTF-8">
    <title>Riepilogo finale</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container">
        <div class="card wizard-card mt-5 p-4">

            <h4 class="text-center mb-4">Riepilogo Dati Inseriti</h4>

            <h5>Dati Anagrafici</h5>
            <ul class="list-group mb-3">
                <?php foreach ($_SESSION['form_anagrafici'] as $key => $value): ?>
                    <li class="list-group-item">
                        <strong><?= label($key) ?>:</strong> <?= htmlspecialchars($value) ?>
                    </li>
                <?php endforeach; ?>
            </ul>

            <h5>Dati di Contatto</h5>
            <ul class="list-group mb-4">
                <?php foreach ($_SESSION['form_contatto'] as $key => $value): ?>
                    <li class="list-group-item">
                        <strong><?= label($key) ?>:</strong> <?= htmlspecialchars($value) ?>
                    </li>
                <?php endforeach; ?>
            </ul>

            <div class="d-flex justify-content-center mt-4">
                <a href="step2.php" class="btn btn-warning">Modifica</a>
            </div>

        </div>
    </div>

</body>

</html>