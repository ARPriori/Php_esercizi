<?php
session_start();
require_once "quiz_data.php";

if (isset($_POST["action"])) {
    $action = $_POST["action"];
    $current = $_SESSION["current_question"];

    // Vado avanti -> salvo la risposta
    if($action === "next" && isset($_POST["answer"])){
        $_SESSION["answers"][$current] = intval($_POST["answer"]);
        $_SESSION["current_question"]++;
    }

    // Torno indietro -> torno alla domanda precedente
    if($action === "prev"){
        if($current > 0){
            $_SESSION["current_question"]--;
        }
    }
}

header("Location: index.php");
exit;