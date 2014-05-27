<script>
    //Display a confirmation box when trying to delete an object
    function showConfirm(id)
    {
        // build the confirmation box
        var c = confirm("Ar tikrai norite ištrinti?");



        // if true, delete item and refresh
        if(c)
            window.location = "ZooOverview.php?delete=" + id;
    }
</script>
<?php

require ("Model/ZooModel.php");

//Contains non-database related function for the Zoo page
class ZooController {

    function CreateOverviewTable() {
        $result = "
            <table class='overViewTable'>
                <tr>
                    <td></td>
                    <td></td>
                    <td><b>Id</b></td>
                    <td><b>Pavadinimas</b></td>
                    <td><b>Rūšis</b></td>
                    <td><b>Porūšis</b></td>
                    <td><b>Mokslinis pavadinimas</b></td>
                    <td><b>Paplitimas</b></td>
                </tr>";

        $ZooArray = $this->GetZooByType('%');

        foreach ($ZooArray as $key => $value) {
            $result = $result .
                "<tr>
                        <td><a href='ZooAdd.php?update=$value->id'>Atnaujinti</a></td>
                        <td><a href='#' onclick='showConfirm($value->id)'>Ištrinti</a></td>
                        <td>$value->id</td>
                        <td>$value->pavadinimas</td>
                        <td>$value->rusis</td>
                        <td>$value->porusis</td>
                        <td>$value->mokslinis_pavadinimas</td>
                        <td>$value->paplitimas</td>
                    </tr>";
        }

        $result = $result . "</table>";
        return $result;
    }
    function CreateZooDropdownList() {
        $ZooModel = new ZooModel();
        $result = "<form action = '' method = 'post' width = '200px'>
                    Pasirinkite rušį:
                    <select name = 'types' >
                        <option value = '%' >Visos</option>
                        " . $this->CreateOptionValues($ZooModel->GetZooTypes()) .
                "</select>
                     <input type = 'submit' value = 'Ieškoti' />
                    </form>";

        return $result;
    }
    function CreateLink() {
        $ZooModel = new ZooModel();
        $result = "<ul><li><a href='index.php'>Visos</a> </li>". $this->CreateLink2($ZooModel->GetZooTypes())." </ul>";
        return $result;

    }
    function CreateLink2(array $valueArray) {
    $result = "";

    foreach ($valueArray as $value) {
        $result = $result . "<li><a href='index.php?types=$value'>$value</a></li>";
    }

    return $result;
}
    function CreateOptionValues(array $valueArray) {
        $result = "";

        foreach ($valueArray as $value) {
            $result = $result . "<option value='$value'>$value</option>";
        }

        return $result;
    }
    
    function CreateZooTables($types)
    {
        $ZooModel = new ZooModel();
        $ZooArray = $ZooModel->GetZooByType($types);
        $result = "";
        
        //Generate a ZooTable for each ZooEntity in array
        foreach ($ZooArray as $key => $Zoo) 
        {
            $result = $result .
                    "<table class = 'ZooTable'>
                        <tr>
                            <th rowspan='6' width = '150px' ><img runat = 'server' src = '$Zoo->paveikslelis' /></th>
                            <th width = '75px' >Pavadinimas: </th>
                            <td>$Zoo->pavadinimas</td>
                        </tr>
                        
                        <tr>
                            <th>Rūšis: </th>
                            <td>$Zoo->rusis</td>
                        </tr>
                        
                        <tr>
                            <th>Porūšis: </th>
                            <td>$Zoo->porusis</td>
                        </tr>
                        
                        <tr>
                            <th>Mokslinis pavadinimas: </th>
                            <td>$Zoo->mokslinis_pavadinimas</td>
                        </tr>
                        
                        <tr>
                            <th>Paplitimas: </th>
                            <td>$Zoo->paplitimas</td>
                        </tr>
                        
                        <tr>
                            <td colspan='2' >$Zoo->aprasymas</td>
                        </tr>                      
                     </table>";
        }        
        return $result;
        
    }
    function GetImages() {
        //Select folder to scan
        $handle = opendir("Images");

        //Read all files and store names in array
        while ($paveikslelis = readdir($handle)) {
            $paveiksleliai[] = $paveikslelis;
        }

        closedir($handle);

        //Exclude all filenames where filename length < 3
        $imageArray = array();
        foreach ($paveiksleliai as $paveikslelis) {
            if (strlen($paveikslelis) > 2) {
                array_push($imageArray, "Images/".$paveikslelis);
            }
        }

        //Create <select><option> Values and return result
        $result = $this->CreateOptionValues($imageArray);
        return $result;
    }

    function InsertZoo() {
        $pavadinimas = $_POST["txtPavadinimas"];
        $rusis = $_POST["txtRūšis"];
        $porusis = $_POST["txtPorūšis"];
        $mokslinis_pavadinimas = $_POST["txtMokslinis"];
        $paplitimas = $_POST["txtPaplitimas"];
        $paveikslelis = $_POST["ddlPaveikslėlis"];
        $aprasymas = $_POST["txtAprašymas"];

        $Zoo = new ZooEntity(-1, $pavadinimas, $rusis, $porusis, $mokslinis_pavadinimas, $paplitimas, $paveikslelis, $aprasymas);
        $ZooModel = new ZooModel();
        $ZooModel->InsertZoo($Zoo);
    }

    function UpdateZoo($id) {
        $pavadinimas = $_POST["txtPavadinimas"];
        $rusis = $_POST["txtRūšis"];
        $porusis = $_POST["txtPorūšis"];
        $mokslinis_pavadinimas = $_POST["txtMokslinis"];
        $paplitimas = $_POST["txtPaplitimas"];
        $paveikslelis = $_POST["ddlPaveikslėlis"];
        $aprasymas = $_POST["txtAprašymas"];

        $Zoo = new ZooEntity($id, $pavadinimas, $rusis, $porusis, $mokslinis_pavadinimas, $paplitimas, $paveikslelis, $aprasymas);
        $ZooModel = new ZooModel();
        $ZooModel->UpdateZoo($id, $Zoo);
    }

    function DeleteZoo($id)
    {
        $ZooModel = new ZooModel();
        $ZooModel->DeleteZoo($id);
    }

    function GetZooById($id) {
        $ZooModel = new ZooModel();
        return $ZooModel->GetZooById($id);
    }

    function GetZooByType($type) {
        $ZooModel = new ZooModel();
        return $ZooModel->GetZooByType($type);
    }

    function GetZooTypes() {
        $ZooModel = new ZooModel();
        return $ZooModel->GetZooTypes();
    }


}

?>
