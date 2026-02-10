<?php
include("./connection.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body class="">
    <h1 class="my-4 text-center">Add Order</h1>

    <?php if (isset($_GET['success'])): ?>
        <?php if ($_GET['success'] == 1): ?>
            <div class="alert alert-success text-center w-75 m-auto" role="alert">
                Ordine aggiunto correttamente!
            </div>
        <?php elseif ($_GET['success'] == 0): ?>
            <div class="alert alert-danger text-center w-75 m-auto" role="alert">
                Errore nell'inserimento dell'ordine. Riprova!
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <form action="./saveOrder.php" method="POST" class="w-75 m-auto">

        <!-- CUSTOMER AUTOCOMPLETE -->
        <div class="mb-3">
            <label class="form-label">Customer</label>
            <select id="customerName" class="form-select" name="customerName">
                <?php
                $sql = "SELECT customerName FROM customers";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option>" . $row["customerName"] . "</option>";
                    }
                } else {
                    echo "<option  disabled=''>Customers Not Found</option>";
                }
                ?>
            </select>
        </div>

        <!-- PRODUCT AUTOCOMPLETE -->
        <div class="mb-3">
            <label class="form-label">Product</label>
            <select id="productName" class="form-select" name="productName">
                <?php
                $sql = "SELECT productName FROM products";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option>" . $row["productName"] . "</option>";
                    }
                } else {
                    echo "<option  disabled=''>Customers Not Found</option>";
                }
                ?>
            </select>
        </div>

        <!-- QUANTITY -->
        <div class="mb-3">
            <label class="form-label">Quantity</label>
            <input type="number" name="quantity" class="form-control" required>
        </div>

        <button class="btn btn-light">Save Order</button>
    </form>

    <div class="text-center my-3">
        <a href="./index.php" class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Go Back</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>