<?php
session_start();
require_once "quiz_data.php";

if (isset($_POST["answer"])) {
    $current = $_SESSION["current_question"];
    $_SESSION["answers"][$current] = intval($_POST["answer"]);
    $_SESSION["current_question"]++;
}

header("Location: index.php");
exit;