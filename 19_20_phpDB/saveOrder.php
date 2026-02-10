<?php
include("./connection.php");

if (!isset($_POST['customerName'], $_POST['productName'], $_POST['quantity'])) {
    die("Dati mancanti");
}

$conn->begin_transaction();

try {
    // Dati raccolti dal form
    $customerName = $_POST["customerName"];
    $productName = $_POST["productName"];
    $quantity = $_POST["quantity"];


    // Info per tabella Orders
    $orderDate = date("Y-m-d");
    $requiredDate = date("Y-m-d", strtotime("+" . rand(1, 10) . " days"));
    $status = "In Process";

    $sql = "SELECT customerNumber FROM customers WHERE customerName = '$customerName'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $customerNumber = $row['customerNumber'];

    $sql = "INSERT INTO orders (orderDate, requiredDate, status, customerNumber) VALUES ('$orderDate', '$requiredDate', '$status', $customerNumber)";
    if (!$conn->query($sql)) {
        die("Errore orders: " . $conn->error);
    }

    // Info per tabella Orderdetails
    $orderNumber = $conn->insert_id;
    $quantityOrdered = $quantity;
    $orderLineNumber = rand(1, 20);

    $sql = "SELECT productCode, buyPrice FROM products WHERE productName = '$productName'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $productCode = $row['productCode'];
    $priceEach = $row['buyPrice'];

    $sql = "INSERT INTO orderdetails(orderNumber, productCode, quantityOrdered, priceEach, orderLineNumber) VALUES ($orderNumber, '$productCode', $quantityOrdered, $priceEach, $orderLineNumber)";
    if (!$conn->query($sql)) {
        die("Errore orderdetails: " . $conn->error);
    }

    // Infor per la tabella payments
    $checkNumber = "CN" . random_int(100000, 999999);
    $paymentDate = $orderDate;

    $sql = "SELECT SUM(od.quantityOrdered * od.priceEach) AS total FROM orders o JOIN orderdetails od ON o.orderNumber = od.orderNumber WHERE o.customerNumber = $customerNumber AND o.orderDate = '$orderDate'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $amount = $row['total'] ?? 0;

    $sql = "INSERT INTO payments (customerNumber, checkNumber, paymentDate, amount) VALUES ($customerNumber, '$checkNumber', '$paymentDate', $amount)";
    if (!$conn->query($sql)) {
        die("Errore payments: " . $conn->error);
    }
    $conn->commit();
    header("Location: addOrder.php?success=1");
} catch (Exception $e) {
    $conn->rollback();
    header("Location: addOrder.php?success=0");
}

?>