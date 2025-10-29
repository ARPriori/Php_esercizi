<?php
session_start();

if (isset($_POST['reset'])) {
    session_unset();
    session_destroy();
    session_start();
}

if (!isset($_SESSION["counter"])) {
    $_SESSION["counter"] = 1;
} else {
    $_SESSION["counter"]++;
}

$_SESSION["lastVisit"] = date('Y-m-d H:i:s');
?>

<!DOCTYPE html>
<html lang="eng">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contatore Sessione</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f3e6f8; /* viola chiaro pastello */
            color: #3e2c4a;
        }

        .card {
            background-color: #ffffff;
            border: 1px solid #d3bce2;
            border-radius: 0.75rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .card-title {
            color: #6f3c84;
            font-weight: 600;
        }

        .btn-custom {
            background-color: #b583c3;
            border: none;
            color: #fff;
            transition: background-color 0.2s ease;
        }

        .btn-custom:hover {
            background-color: #9a6da8;
        }

        .counter-number {
            font-size: 2.2rem;
            font-weight: 600;
            color: #6f3c84;
        }

        .visit-time {
            font-size: 0.95rem;
            color: #6c5675;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card text-center p-4">
                    <h1 class="card-title mb-3">Contatore Sessione</h1>

                    <p>Hai visitato questa pagina</p>
                    <div class="counter-number mb-2"><?= $_SESSION["counter"] ?></div>
                    <p class="visit-time">Ultima visita: <?= $_SESSION["lastVisit"] ?></p>

                    <form method="post" class="mt-4">
                        <button type="submit" name="reset" class="btn btn-custom px-4 py-2 rounded-pill">
                            Azzera sessione
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
