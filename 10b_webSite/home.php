<?php
session_start();

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit;
}

// Calcola il tempo trascorso
$login_time = $_SESSION["login_time"] ?? time();
$tempo_trascorso = time() - $login_time;
$ore = floor($tempo_trascorso / 3600);
$minuti = floor(($tempo_trascorso % 3600) / 60);
$secondi = $tempo_trascorso % 60;

// Formatta la data del login
$data_login = date("d/m/Y H:i:s", $login_time);
?>

<!DOCTYPE html>
<html lang="eng">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f2ecf8; 
            color: #3e2c4a;
        }

        .container {
            max-width: 400px;
            background-color: #ffffff;
            border: 1px solid #d4bce7;
            border-radius: 0.75rem;
            padding: 2rem;
        }

        h2 {
            color: #6a3f8d;
            font-weight: 600;
        }

        .btn-danger {
            background-color: #b57db7;
            border: none;
        }

        .btn-danger:hover {
            background-color: #9d6aa0;
        }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center vh-100">

    <div class="container text-center">
        <h2 class="mb-3">Benvenuto, <?= htmlspecialchars($_SESSION["user"]) ?>!</h2>
        <p>Hai effettuato l’accesso con successo.</p>
        <p><strong>Data login:</strong> <?= $data_login ?></p>
    <p><strong>Tempo trascorso:</strong> <?= "$ore ore, $minuti min, $secondi sec" ?></p>
        <a href="logout.php" class="btn btn-danger mt-3">Logout</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
