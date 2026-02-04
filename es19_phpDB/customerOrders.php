<?php
include("./connection.php");

if (!isset($_GET['customerNumber'])) {
    echo "Customer Not Found";
}

$customerNumber = $_GET['customerNumber'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body class="text-center">
    <h1>Customer Orders</h1>

    <?php
    $sql = "SELECT o.orderNumber, o.orderDate, o.status, od.productCode, od.quantityOrdered, od.priceEach FROM orders o JOIN orderdetails od ON o.orderNumber = od.orderNumber WHERE o.customerNumber = $customerNumber ORDER BY o.orderDate DESC";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo '<table class="table table-striped table-hover m-auto my-4 w-75">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Product Code</th>
                        <th>Quantity</th>
                        <th>Price Each</th>
                    </tr>
                </thead>
                <tbody>';
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["orderNumber"] . "</td><td>" . $row["orderDate"] . "</td><td>" . $row["status"] . "</td><td>" . $row["productCode"] . "</td><td>" . $row["quantityOrdered"] . "</td><td>" . $row["priceEach"] . "</td></tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<p>Orders Not Found</p>";
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>