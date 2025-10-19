<?php
// Funzione di sanificazione
function sanitize_input($data)
{
    return htmlspecialchars(stripslashes(trim($data)));
}

// Inizializza
$name = $surname = $email = $message = "";
$errors = [];
$success = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanifica
    $name = sanitize_input($_POST["name"] ?? "");
    $surname = sanitize_input($_POST["surname"] ?? "");
    $email = sanitize_input($_POST["email"] ?? "");
    $message = sanitize_input($_POST["message"] ?? "");

    // Validazioni
    if (!preg_match("/^[a-zA-ZÀ-ÿ\s]+$/u", $name)) {
        $errors[] = "Nome non valido";
    }
    if (!preg_match("/^[a-zA-ZÀ-ÿ\s]+$/u", $surname)) {
        $errors[] = "Cognome non valido";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email non valida";
    }
    if (mb_strlen($message) > 300) {
        $errors[] = "Messaggio troppo lungo";
    }

    if (empty($errors)) {
        $success = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body class="bg-success-subtle">

    <?php if ($success): ?>

        <!-- MESSAGGIO DI SUCCESSO -->
        <div class="alert alert-success mt-4 w-50 m-auto">
            <h4 class="alert-heading text-success mb-3">Grazie per il tuo messaggio!</h4>
            <p><strong>Nome:</strong> <?= $name ?></p>
            <p><strong>Cognome:</strong> <?= $surname ?></p>
            <p><strong>Email:</strong> <?= $email ?></p>
            <p><strong>Messaggio:</strong> <?= nl2br($message) ?></p>

            <!-- pulsante per tornare al form -->
            <div class="text-center mt-4">
                <a href="" class="btn btn-outline-success">Back to Form</a>
            </div>
        </div>

    <?php else: ?>

        <h1 class="text-center text-success mt-4">Contatto</h1>

        <!-- MESSAGGIO DI ERRORE -->
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger mt-4">
                <ul>
                    <?php foreach ($errors as $err): ?>
                        <li><?= $err ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- FORM -->
        <form class="w-50 m-auto mt-4" method="post" onsubmit="return validateFormJS();">
            <!-- nome -->
            <div class="mb-3">
                <label for="inputName" class="form-label text-success-emphasis">Name</label>
                <input type="text" class="form-control" id="inputName" name="name" required
                    value="<?= htmlspecialchars($name) ?>">
            </div>
            <!-- cognome -->
            <div class="mb-3">
                <label for="inputSurname" class="form-label text-success-emphasis">Surname</label>
                <input type="text" class="form-control" id="inputSurname" name="surname" required
                    value="<?= htmlspecialchars($surname) ?>">
            </div>
            <!-- indirizzo email -->
            <div class="mb-3">
                <label for="inputEmail" class="form-label text-success-emphasis">Email address</label>
                <input type="email" class="form-control" id="inputEmail" name="email" aria-describedby="emailHelp" required
                    value="<?= htmlspecialchars($email) ?>">
            </div>
            <!-- optional message -->
            <div class="mb-3">
                <label for="inputMessage" class="form-label text-success-emphasis">Messaggio (opzionale, max 300
                    caratteri)</label>
                <textarea class="form-control" id="inputMessage" name="message" maxlength="300"
                    rows="4"><?= htmlspecialchars($message) ?></textarea>
            </div>

            <button type="submit" class="btn btn-outline-success">Submit</button>
        </form>

    <?php endif; ?>


    <script>
        function validateFormJS() {
            const name = document.getElementById("inputName").value.trim();
            const surname = document.getElementById("inputSurname").value.trim();
            const email = document.getElementById("inputEmail").value.trim();
            const message = document.getElementById("inputMessage").value.trim();

            const nameRegEx = /^[a-zA-ZÀ-ÿ\s]+$/u;

            // Validazione nome
            if (!nameRegEx.test(name)) {
                alert("Il nome può contenere solo lettere e spazi.");
                return false;
            }

            // Validazione cognome
            if (!nameRegEx.test(surname)) {
                alert("Il cognome può contenere solo lettere e spazi.");
                return false;
            }

            // Validazione email (già gestita anche da HTML5, ma aggiungiamo un controllo JS)
            if (!/^\S+@\S+\.\S+$/.test(email)) {
                alert("Inserisci un'email valida.");
                return false;
            }

            // Validazione messaggio
            if (message.length > 300) {
                alert("Il messaggio non può superare i 300 caratteri.");
                return false;
            }

            return true;
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>