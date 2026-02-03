<?php
$servernameDB = "localhost";
$usernameDB = "root";
$passwordDB = "";
$dbnameDB = "classicmodels";

//disabilita le eccezioni nelle nuove versioni di PHP
mysqli_report(MYSQLI_REPORT_OFF);

$conn = new mysqli($servernameDB, $usernameDB, $passwordDB, $dbnameDB);
$conn->set_charset("utf8mb4"); //permette l'uso di lettere accentate

/* Due possibili casi:
- La connessione va a buon fine: l'oggetto $conn nel campo connect_error ha null
- La connessione NON va a buon fine: l'oggetto $conn nel campo connect_error ha una stringa contenente l'errore 
*/
if($conn->connect_error){
    header("Location: error.html");
}
?>