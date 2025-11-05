<?php
session_start();

$camerieri = [
    'MAc001' => 'Blu!2025',
    'MAc002' => 'Gusto#88',
    'MAc003' => 'Serve&123',
    'MAc004' => 'Tavolo_Pass9',
    'MAc005' => 'Cucina$42',
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $serial = $_POST["serial_num"] ?? '';
    $password = $_POST["password"] ?? '';

     if (isset($camerieri[$serial]) && $camerieri[$serial] === $password) {
        $_SESSION["cameriere"] = $serial;
        header("Location: record.php");
        exit;
    } else {
        $errore = "Credenziali non valide!";
    }
}
?>

<!DOCTYPE html>
<html lang="eng">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body data-bs-theme="dark">

    <div class="container vh-100 d-flex justify-content-center align-items-center">
        <div class="card p-4" style="width: 22rem;">
            <h3 class="text-center mb-4">Portale Cameriere</h3>

            <?php if (isset($errore)): ?>
                <div class="alert alert-danger py-2 text-center"><?= $errore ?></div>
            <?php endif; ?>

            <form method="post" action="">
                <!-- username -->
                <div class="mb-3">
                    <label for="inputUser" class="form-label">Matricola</label>
                    <input type="text" class="form-control" id="inputUser" name="serial_num" required>
                </div>

                <!-- password -->
                <div class="mb-3">
                    <label for="inputPassword" class="form-label">Password</label>
                    <input type="password" class="form-control" id="inputPassword" name="password" required>
                </div>

                <!-- button -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-light">Accedi</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>
</html>
