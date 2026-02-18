<?php
session_start();
include("./connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verifica le credenziali
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = SHA2('$password', 256)";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Login riuscito, salva nella sessione
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit;
    } else {
        $error = "Credenziali non valide";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card" style="width: 100%; max-width: 400px;">

            <div class="card-body">
                <h4 class="card-title text-center mb-4">Login</h4>

                <?php if (isset($error)): ?>
                    <div class="alert alert-danger">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>

                <form action="login.php" method="POST" class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label small text-muted">Username</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label small text-muted">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="col-md-12 d-flex align-items-end">
                        <button type="submit" class="btn btn-dark w-100">Login</button>
                    </div>
                </form>
            </div>
            
        </div>
    </div>

</body>

</html>