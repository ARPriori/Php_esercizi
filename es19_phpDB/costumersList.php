<?php
include("./connection.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Costumers List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body class="text-center">
    <h1>Costumers List</h1>

    <?php
    $sql = "SELECT customerName as name, CONCAT(contactLastName, ' ', contactFirstName) as contact, phone, addressLine1 as address, city, creditLimit FROM customers";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo '<table class="table table-striped table-hover m-auto my-4">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>Credit</th>
                    </tr>
                </thead>
                <tbody>';
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["name"] . "</td><td>" . $row["contact"] . "</td><td>" . $row["phone"] . "</td><td>" . $row["address"] . "</td><td>" . $row["city"] . "</td><td>" . $row["creditLimit"] . "</td></tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<p>Customer Not Found</p>";
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>