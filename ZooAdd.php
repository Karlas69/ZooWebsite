<?php

include("config.php");

session_start();
// Check if user is logged and existing session
if(isset($_SESSION['logat'])) {
// Content for user logged
    require './Controller/ZooController.php';
    $ZooController = new ZooController();

    $title = "Pridėti gyvūną";

    if(isset($_GET["update"]))
    {
        $Zoo = $ZooController->GetZooById($_GET["update"]);

        $content ="<form action='' method='post'>
    <fieldset>
        <legend>Atnaujinti informaciją</legend>
        <label for='pavadinimas'>Pavadinimas: </label>
        <input type='text' class='inputField' name='txtPavadinimas' value='$Zoo->pavadinimas'  /></br>

        <label for='rūšis'>Rūšis: </label>
        <input type='text' class='inputField' name='txtRūšis' value='$Zoo->rusis'/></br>

        <label for='porūšis'>Porūšis: </label>
        <input type='text' class='inputField' name='txtPorūšis' value='$Zoo->porusis'/></br>

        <label for='mokslinis'>Mokslinis pavadinimas: </label>
        <input type='text' class='inputField' name='txtMokslinis' value='$Zoo->mokslinis_pavadinimas' /></br></br>

        <label for='paplitimas'>Paplitimas: </label>
        <input type='text' class='inputField' name='txtPaplitimas' value='$Zoo->paplitimas' /><br/>

        <label for='paveikslėlis'>Paveikslėlis: </label>
        <select class='inputField' name='ddlPaveikslėlis'>
        <option >$Zoo->paveikslelis</option>"
            .$ZooController->GetImages().
            "</select></br>

        <label for='aprašymas'>Aprašymas: </label>
        <textarea cols='70' rows='12' name='txtAprašymas'>$Zoo->aprasymas</textarea></br>

        <input type='submit' value='Gerai'>
    </fieldset>
</form>";
    }
    else
    {
        $content ="<form action='' method='post'>
    <fieldset>
        <legend>Pridėti naują gyvūną</legend>
        <label for='pavadinimas'>Pavadinimas: </label>
        <input type='text' class='inputField' name='txtPavadinimas' /><br/>

        <label for='rūšis'>Rūšis: </label>
            <input type='text' class='inputField' name='txtRūšis' /><br/>



            <label for='porūšis'>Porūšis: </label>
            <input type='text' class='inputField' name='txtPorūšis' /><br/>

            <label for='mokslinis'>Mokslinis pavadinimas: </label>
            <input type='text' class='inputField' name='txtMokslinis' /></br></br>

            <label for='paplitimas'>Paplitimas: </label>
            <input type='text' class='inputField' name='txtPaplitimas' /><br/>

            <label for='paveikslėlis'>Paveikslėlis: </label>
            <select class='inputField' name='ddlPaveikslėlis'>"
            .$ZooController->GetImages().
            "</select></br>

            <label for='aprašymas'>Aprašymas: </label>
            <textarea cols='70' rows='12' name='txtAprašymas'></textarea></br>

            <input type='submit' value='Gerai'>
        </fieldset>
    </form>";
    }


    if(isset($_GET["update"]))
    {
        if(isset($_POST["txtPavadinimas"]))
        {
            $ZooController->UpdateZoo($_GET["update"]);
        }
    }
    else
    {
        if(isset($_POST["txtPavadinimas"]))
        {
            $ZooController->InsertZoo();
        }
    }

    include './Template.php';
} else {
// Redirecting to login page
    Header('Location: index2.php');
}

?>


