<?php
session_start();

// Inizializza i dati della sessione se non esistono
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_POST as $key => $value) {
        if (isset($_SESSION['form_anagrafici'][$key])) {
            $_SESSION['form_anagrafici'][$key] = $value;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="eng">
<head>
<meta charset="UTF-8">
<title>Wizard Anagrafici</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    .step { display: none; }
    .step.active { display: block; }
    .wizard-card {
        max-width: 550px;
        margin: auto;
        margin-top: 50px;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
</style>
</head>
<body>

<div class="container">
    <div class="card wizard-card">
        <div class="card-body">
            <h4 class="card-title text-center mb-4">Registrazione - Dati Anagrafici</h4>

            <!-- Progress bar -->
            <div  class="progress my-3">
                <div id="progressBar" class="progress-bar bg-warning" style="width: 14%"  role="progressbar" aria-label="Warning example" aria-valuenow="1" aria-valuemin="0" aria-valuemax="7"></div>
            </div>

            <form method="POST" id="wizardForm" action="step2.php">

                <!-- Step 1: Nome -->
                <div class="step active" id="step1">
                    <div class="mb-3">
                        <label class="form-label">Nome</label>
                        <input type="text" name="nome" class="form-control"
                               value="<?= htmlspecialchars($_SESSION['form_anagrafici']['nome']) ?>" required>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-warning" onclick="nextStep(2)">Avanti</button>
                    </div>
                </div>

                <!-- Step 2: Cognome -->
                <div class="step" id="step2">
                    <div class="mb-3">
                        <label class="form-label">Cognome</label>
                        <input type="text" name="cognome" class="form-control"
                               value="<?= htmlspecialchars($_SESSION['form_anagrafici']['cognome']) ?>" required>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary" onclick="prevStep(1)">Indietro</button>
                        <button type="button" class="btn btn-warning" onclick="nextStep(3)">Avanti</button>
                    </div>
                </div>

                <!-- Step 3: Data di nascita -->
                <div class="step" id="step3">
                    <div class="mb-3">
                        <label class="form-label">Data di nascita</label>
                        <input type="date" name="data_nascita" class="form-control"
                               value="<?= htmlspecialchars($_SESSION['form_anagrafici']['data_nascita']) ?>" required>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary" onclick="prevStep(2)">Indietro</button>
                        <button type="button" class="btn btn-warning" onclick="nextStep(4)">Avanti</button>
                    </div>
                </div>

                <!-- Step 4: Genere -->
                <div class="step" id="step4">
                    <div class="mb-3">
                        <label class="form-label">Genere</label>
                        <select name="genere" class="form-select" required>
                            <option value="">Seleziona...</option>
                            <option value="Maschio" <?= $_SESSION['form_anagrafici']['genere']=='Maschio'?'selected':'' ?>>Maschio</option>
                            <option value="Femmina" <?= $_SESSION['form_anagrafici']['genere']=='Femmina'?'selected':'' ?>>Femmina</option>
                            <option value="Altro" <?= $_SESSION['form_anagrafici']['genere']=='Altro'?'selected':'' ?>>Altro</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary" onclick="prevStep(3)">Indietro</button>
                        <button type="button" class="btn btn-warning" onclick="nextStep(5)">Avanti</button>
                    </div>
                </div>

                <!-- Step 5: Codice Fiscale -->
                <div class="step" id="step5">
                    <div class="mb-3">
                        <label class="form-label">Codice Fiscale</label>
                        <input type="text" name="codice_fiscale" class="form-control"
                               value="<?= htmlspecialchars($_SESSION['form_anagrafici']['codice_fiscale']) ?>">
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary" onclick="prevStep(4)">Indietro</button>
                        <button type="button" class="btn btn-warning" onclick="nextStep(6)">Avanti</button>
                    </div>
                </div>

                <!-- Step 6: Nazionalità -->
                <div class="step" id="step6">
                    <div class="mb-3">
                        <label class="form-label">Nazionalità</label>
                        <input type="text" name="nazionalita" class="form-control"
                               value="<?= htmlspecialchars($_SESSION['form_anagrafici']['nazionalita']) ?>">
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary" onclick="prevStep(5)">Indietro</button>
                        <button type="button" class="btn btn-warning" onclick="nextStep(7)">Avanti</button>
                    </div>
                </div>

                <!-- Step 7: Luogo di nascita -->
                <div class="step" id="step7">
                    <div class="mb-3">
                        <label class="form-label">Luogo di nascita</label>
                        <input type="text" name="luogo_nascita" class="form-control"
                               value="<?= htmlspecialchars($_SESSION['form_anagrafici']['luogo_nascita']) ?>">
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary" onclick="prevStep(6)">Indietro</button>
                        <button type="submit" class="btn btn-warning">Conferma</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
    const totalSteps = 7;
    const progressBar = document.getElementById("progressBar");

    function showStep(step){
        for(let i=1;i<=totalSteps;i++){
            document.getElementById("step"+i).classList.remove("active");
        }
        document.getElementById("step"+step).classList.add("active");

        let perc = (step/totalSteps) * 100;
        progressBar.style.width = perc + "%";
    }

    function nextStep(step){
        setTimeout(()=>{ showStep(step); },50);
    }

    function prevStep(step){
        showStep(step);
    }

    showStep(1);
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
