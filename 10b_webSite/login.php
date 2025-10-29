<?php
session_start();

$utentiValidi = [
    "admin" => "1234",
    "mario" => "pass1",
    "lucia" => "pass2"
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"] ?? '';
    $password = $_POST["password"] ?? '';

     if (isset($utentiValidi[$username]) && $utentiValidi[$username] === $password) {
        $_SESSION["user"] = $username;
        $_SESSION["login_time"] = time(); // registra il timestamp del login
        header("Location: home.php");
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f2ecf8; 
            color: #3e2c4a;
        }

        .card {
            background-color: #ffffff;
            border: 1px solid #d4bce7;
            border-radius: 0.75rem;
        }

        .card h3 {
            color: #6a3f8d;
            font-weight: 600;
        }

        .btn-primary {
            background-color: #a77dc2;
            border: none;
        }

        .btn-primary:hover {
            background-color: #946caf;
        }

        .alert-danger {
            background-color: #f7d6e0;
            border-color: #f7d6e0;
            color: #7a2e45;
        }
    </style>
</head>

<body>

    <div class="container vh-100 d-flex justify-content-center align-items-center">
        <div class="card p-4" style="width: 22rem;">
            <h3 class="text-center mb-4">Login</h3>

            <?php if (isset($errore)): ?>
                <div class="alert alert-danger py-2 text-center"><?= $errore ?></div>
            <?php endif; ?>

            <form method="post" action="">
                <!-- username -->
                <div class="mb-3">
                    <label for="inputUser" class="form-label">Username</label>
                    <input type="text" class="form-control" id="inputUser" name="username" required>
                </div>

                <!-- password -->
                <div class="mb-3">
                    <label for="inputPassword" class="form-label">Password</label>
                    <input type="password" class="form-control" id="inputPassword" name="password" required>
                </div>

                <!-- button -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Accedi</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
