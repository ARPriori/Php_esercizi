<?php
session_start();
include("./connection.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Customers Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-white">

    <div class="container py-4">

        <!-- TITLE -->
        <div class="mb-4 border-bottom pb-2">
            <h4 class="fw-semibold mb-0">Customers Management</h4>
        </div>

        <!-- ================= ADD ORDER ================= -->
        <div class="mb-5 border border-secondary-subtle rounded-3 p-4 text-center">

            <?php if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']): ?>
                <!-- Se Utente non Loggato - Visualizzo pulsante per login -->
                <a href="login.php" class="btn btn-outline-secondary w-50">Login to Add Order</a>
            <?php else: ?>
                <!-- Se Utente Loggato - Visualizzo Form Aggiunta Ordine -->
                <h6 class="text-uppercase text-muted mb-3">Add Order</h6>

                <?php if (isset($_GET['success'])): ?>
                    <?php if ($_GET['success'] == 1): ?>
                        <div class="alert alert-success py-2">
                            Order added successfully.
                        </div>
                    <?php else: ?>
                        <div class="alert alert-danger py-2">
                            Error while inserting order.
                        </div>
                    <?php endif; ?>
                <?php endif; ?>

                <form action="./saveOrder.php" method="POST" class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label small text-muted">Customer</label>
                        <select class="form-select" name="customerName" required>
                            <?php
                            $result = $conn->query("SELECT customerName FROM customers");
                            while ($row = $result->fetch_assoc()) {
                                echo "<option>{$row['customerName']}</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small text-muted">Product</label>
                        <select class="form-select" name="productName" required>
                            <?php
                            $result = $conn->query("SELECT productName FROM products");
                            while ($row = $result->fetch_assoc()) {
                                echo "<option>{$row['productName']}</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label small text-muted">Quantity</label>
                        <input type="number" name="quantity" class="form-control" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label small text-muted">Price Each</label>
                        <input type="number" step="0.01" name="priceEach" class="form-control" required>
                    </div>

                    <div class="col-md-4 d-flex align-items-end">
                        <button class="btn btn-dark w-100">
                            Save Order
                        </button>
                    </div>

                </form>
            <?php endif; ?>
        </div>

        <!-- ================= CUSTOMERS LIST ================= -->
        <div>
            <h6 class="text-uppercase text-muted mb-3">Customers List</h6>
            <?php $sql = "SELECT customerNumber, customerName as name, CONCAT(contactLastName,' ',contactFirstName) as contact, phone,addressLine1 as address,city,creditLimit FROM customers";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                echo ' <div class="table-responsive"> <table class="table table-striped table-hover align-middle"> <thead class="table-light"> <tr> <th>Name</th> <th>Contact</th> <th>Phone</th> <th>Address</th> <th>City</th> <th class="text-end">Credit</th> </tr> </thead> <tbody>';
                while ($row = $result->fetch_assoc()) {
                    echo " <tr> <td> <a href='customerOrders.php?customerNumber={$row["customerNumber"]}' class='fw-semibold text-dark'> {$row["name"]} </a> </td> <td>{$row["contact"]}</td> <td>{$row["phone"]}</td> <td>{$row["address"]}</td> <td>{$row["city"]}</td> <td class='text-end fw-semibold'> {$row["creditLimit"]} </td> </tr>";
                }
                echo "</tbody></table></div>";
            } else {
                echo "<p class='text-muted'>No customers found.</p>";
            } ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>