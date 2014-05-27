<?php

include("config.php");

session_start();
// Check if user is logged and existing session
if(isset($_SESSION['logat'])) {
// Content for user logged
    $title = "Valdyti gyvūnų informaciją";
    include './Controller/ZooController.php';
    $ZooController = new ZooController();

    $content = $ZooController->CreateOverviewTable();

    if(isset($_GET["delete"]))
    {
        $ZooController->DeleteZoo($_GET["delete"]);
    }

    include './Template.php';
} else {
// Redirecting to login page
    Header('Location: index2.php');
}

?>
