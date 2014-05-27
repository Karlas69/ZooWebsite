<?php
require 'Controller/ZooController.php';
$ZooController = new ZooController();

if(isset($_GET['types']))
{
//Fill page with Zoos of the selected type
    $ZooTables = $ZooController->CreateZooTables($_GET['types']);
}
else
{
//Page is loaded for the first time, no type selected -> Fetch all types
    $ZooTables = $ZooController->CreateZooTables('%');
}

//Output page data
$title = 'Gyvūnai';
$content = $ZooTables;
$content2 = $ZooController->CreateLink();
include 'Template.php';
?>
