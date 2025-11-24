<?php
session_start();

// Inizializza la sessione se vuota
if (!isset($_SESSION['form_anagrafici'])) {
    $_SESSION['form_anagrafici'] = [
        'nome' => '',
        'cognome' => '',
        'data_nascita' => '',
        'genere' => '',
        'codice_fiscale' => '',
        'nazionalita' => '',
        'luogo_nascita' => ''
    ];
}

// Salva i dati ad ogni POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_POST as $key => $value) {
        if (isset($_SESSION['form_anagrafici'][$key])) {
            $_SESSION['form_anagrafici'][$key] = $value;
        }
    }
}

// step corrente dopo submit
$current_step = isset($_POST['current_step']) ? (int) $_POST['current_step'] : 1;
?>
<!DOCTYPE html>
<html lang="eng">

<head>
    <meta charset="UTF-8">
    <title>Wizard Anagrafici</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .step {
            display: none;
        }

        .step.active {
            display: block;
        }

        .wizard-card {
            max-width: 550px;
            margin: 50px auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="card wizard-card">
            <div class="card-body">
                <h4 class="text-center mb-4">Registrazione - Dati Anagrafici</h4>

                <div class="progress my-3">
                    <div id="progressBar" class="progress-bar bg-warning" style="width: 14%"></div>
                </div>

                <form method="POST" action="step1.php" id="wizardForm">

                    <input type="hidden" name="current_step" id="current_step" value="<?= $current_step ?>">

                    <!-- Step 1 -->
                    <div class="step" id="step1">
                        <label class="form-label">Nome</label>
                        <input type="text" name="nome" class="form-control"
                            value="<?= htmlspecialchars($_SESSION['form_anagrafici']['nome']) ?>" required>
                        <div class="d-flex justify-content-end mt-3">
                            <button type="button" class="btn btn-warning" onclick="goToStep(2)">Avanti</button>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="step" id="step2">
                        <label class="form-label">Cognome</label>
                        <input type="text" name="cognome" class="form-control"
                            value="<?= htmlspecialchars($_SESSION['form_anagrafici']['cognome']) ?>" required>
                        <div class="d-flex justify-content-between mt-3">
                            <button type="button" class="btn btn-secondary" onclick="goToStep(1)">Indietro</button>
                            <button type="button" class="btn btn-warning" onclick="goToStep(3)">Avanti</button>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="step" id="step3">
                        <label class="form-label">Data di nascita</label>
                        <input type="date" name="data_nascita" class="form-control"
                            value="<?= htmlspecialchars($_SESSION['form_anagrafici']['data_nascita']) ?>" required>
                        <div class="d-flex justify-content-between mt-3">
                            <button type="button" class="btn btn-secondary" onclick="goToStep(2)">Indietro</button>
                            <button type="button" class="btn btn-warning" onclick="goToStep(4)">Avanti</button>
                        </div>
                    </div>

                    <!-- Step 4 -->
                    <div class="step" id="step4">
                        <label class="form-label">Genere</label>
                        <select name="genere" class="form-select" required>
                            <option value="">Seleziona...</option>
                            <option value="Maschio" <?= $_SESSION['form_anagrafici']['genere'] == 'Maschio' ? 'selected' : '' ?>>Maschio</option>
                            <option value="Femmina" <?= $_SESSION['form_anagrafici']['genere'] == 'Femmina' ? 'selected' : '' ?>>Femmina</option>
                            <option value="Altro" <?= $_SESSION['form_anagrafici']['genere'] == 'Altro' ? 'selected' : '' ?>>Altro</option>
                        </select>
                        <div class="d-flex justify-content-between mt-3">
                            <button type="button" class="btn btn-secondary" onclick="goToStep(3)">Indietro</button>
                            <button type="button" class="btn btn-warning" onclick="goToStep(5)">Avanti</button>
                        </div>
                    </div>

                    <!-- Step 5 -->
                    <div class="step" id="step5">
                        <label class="form-label">Codice Fiscale</label>
                        <input type="text" name="codice_fiscale" class="form-control"
                            value="<?= htmlspecialchars($_SESSION['form_anagrafici']['codice_fiscale']) ?>">
                        <div class="d-flex justify-content-between mt-3">
                            <button type="button" class="btn btn-secondary" onclick="goToStep(4)">Indietro</button>
                            <button type="button" class="btn btn-warning" onclick="goToStep(6)">Avanti</button>
                        </div>
                    </div>

                    <!-- Step 6 -->
                    <div class="step" id="step6">
                        <label class="form-label">Nazionalità</label>
                        <input type="text" name="nazionalita" class="form-control"
                            value="<?= htmlspecialchars($_SESSION['form_anagrafici']['nazionalita']) ?>">
                        <div class="d-flex justify-content-between mt-3">
                            <button type="button" class="btn btn-secondary" onclick="goToStep(5)">Indietro</button>
                            <button type="button" class="btn btn-warning" onclick="goToStep(7)">Avanti</button>
                        </div>
                    </div>

                    <!-- Step 7 -->
                    <div class="step" id="step7">
                        <label class="form-label">Luogo di nascita</label>
                        <input type="text" name="luogo_nascita" class="form-control"
                            value="<?= htmlspecialchars($_SESSION['form_anagrafici']['luogo_nascita']) ?>">
                        <div class="d-flex justify-content-between mt-3">
                            <button type="button" class="btn btn-secondary" onclick="goToStep(6)">Indietro</button>
                            <button type="submit" formaction="step2.php" class="btn btn-warning">Continua</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
        function goToStep(step) {
            document.getElementById('current_step').value = step;
            document.getElementById('wizardForm').submit();
        }

        showStep(<?= $current_step ?>);

        function showStep(step) {
            const total = 7;
            document.querySelectorAll('.step').forEach(s => s.classList.remove('active'));
            document.getElementById("step" + step).classList.add('active');
            document.getElementById("progressBar").style.width = (step / total) * 100 + "%";
        }
    </script>

</body>

</html>