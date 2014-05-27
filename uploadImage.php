<?php
include("config.php");

session_start();
// Check if user is logged and existing session
if(isset($_SESSION['logat'])) {
// Content for user logged
    $title = "Įkelti naują paveikslėlį";

    $content = '<form action="" method="post" enctype="multipart/form-data">
    <label for="file">Failas: </label>
    <input type="file" name="file" id="file"><br/>
    <input type="submit" name="submit" value="Gerai">
</form>';

//Check if filetype is a valid format
    if (isset($_POST["submit"])) {
        $fileType = $_FILES["file"]["type"];

        if (($fileType == "image/gif") ||
            ($fileType == "image/jpeg") ||
            ($fileType == "image/jpg") ||
            ($fileType == "image/png")) {
            //Check if file exists
            if (file_exists("Images/" . $_FILES["file"]["name"])) {
                echo "Toks failas jau yra";
            } else {
                move_uploaded_file($_FILES["file"]["tmp_name"], "Images/" . $_FILES["file"]["name"]);
                echo "Įkelta į " . "Images/" . $_FILES["file"]["name"];
            }
        }
    }

    include './Template.php';
} else {
// Redirecting to login page
    Header('Location: index2.php');
}

?>

