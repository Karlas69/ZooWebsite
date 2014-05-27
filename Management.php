<?php
include("config.php");

session_start();
// Check if user is logged and existing session
if(isset($_SESSION['logat'])) {
// Content for user logged
    $title = "Valdymas";


    $content = '<h4>Valdymas</h4>
            <a href="ZooAdd.php">Pridėti naują gyvūną</a><br/>
            <a href="uploadImage.php">Įkelti paveikslėlį</a><br/>
            <a href="ZooOverview.php">Informacijos peržiūra</a><br/>';

    include './Template.php';
} else {
// Redirecting to login page
    Header('Location: index2.php');
}


?>
