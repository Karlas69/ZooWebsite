<?php

require ("Entities/ZooEntity.php");

//Contains database related code for the Zoo page.
class ZooModel {

    //Get all Zoo types from the database and return them in an array.
    function GetZooTypes() {
        require 'Credentials.php';

        //Open connection and Select database.  
        $dbh = new PDO('mysql:host=localhost;dbname=zoodb;charset=utf8', $user, $passwd, array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
        ));

        
        $query = "SELECT DISTINCT rusis FROM gyvunai";
        
        $stmt = $dbh->prepare($query);
        $stmt->execute();

        $rusys = array();

        //Get data from database.
        foreach ($stmt->fetchAll() as $key => $value){
            array_push($rusys, $value[0]);
        }

        //Close connection and return result.
        
        return $rusys;
    }

    //Get ZooEntity objects from the database and return them in an array.
    function GetZooByType($rusis) {
        require 'Credentials.php';

        //Open connection and Select database.
        $dbh = new PDO('mysql:host=localhost;dbname=zoodb;charset=utf8', $user, $passwd, array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
        ));

        $query = "SELECT * FROM gyvunai WHERE rusis LIKE '$rusis'";
        
        $stmt = $dbh->prepare($query);
        $stmt->execute();

        $ZooArray = array();

        //Get data from database.
        foreach ($stmt->fetchAll() as $key => $value) {
            
            $id = $value[0];
            $pavadinimas = $value[1];
            $rusis = $value[2];
            $porusis = $value[3];
            $mokslinis_pavadinimas = $value[4];
            $paplitimas = $value[5];
            $paveikslelis = $value[6];
            $aprasymas = $value[7];
//            print_r($pavadinimas);

            //Create Zoo objects and store them in an array.
            $Zoo = new ZooEntity($id, $pavadinimas, $rusis, $porusis, $mokslinis_pavadinimas, $paplitimas, $paveikslelis, $aprasymas);
            array_push($ZooArray, $Zoo);
        }
        return $ZooArray;
}
    function GetZooById($id) {
        require ('Credentials.php');
        //Open connection and Select database.
        $dbh = new PDO('mysql:host=localhost;dbname=zoodb;charset=utf8', $user, $passwd, array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
        ));


        $query = "SELECT * FROM gyvunai WHERE id = $id";
        $stmt = $dbh->prepare($query);
        $stmt->execute();

        //Get data from database.
            foreach ($stmt->fetchAll() as $key => $value) {


                $pavadinimas = $value[1];
                $rusis = $value[2];
                $porusis = $value[3];
                $mokslinis_pavadinimas = $value[4];
                $paplitimas = $value[5];
                $paveikslelis = $value[6];
                $aprasymas = $value[7];

            //Create Zoo
                $Zoo = new ZooEntity($id, $pavadinimas, $rusis, $porusis, $mokslinis_pavadinimas, $paplitimas, $paveikslelis, $aprasymas);
        }
        return $Zoo;
    }

    function InsertZoo(ZooEntity $Zoo) {
        require 'Credentials.php';
        $dbh = new PDO('mysql:host=localhost;dbname=zoodb;charset=utf8', $user, $passwd, array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
        ));

        $query = "INSERT INTO gyvunai
                          (pavadinimas, rusis, porusis, mokslinis_pavadinimas, paplitimas, paveikslelis, aprasymas)
                          VALUES
                          (:pavadinimas,:rusis,:porusis,:mokslinis_pavadinimas,:paplitimas,:paveikslelis,:aprasymas)";
        $stmt = $dbh->prepare($query);
        $stmt->execute(array(':pavadinimas'=>$Zoo->pavadinimas,
        ':rusis'=>$Zoo->rusis,
        ':porusis'=>$Zoo->porusis,
        ':mokslinis_pavadinimas'=>$Zoo->mokslinis_pavadinimas,
        ':paplitimas'=>$Zoo->paplitimas,
        ':paveikslelis'=>$Zoo->paveikslelis,
        ':aprasymas'=>$Zoo->aprasymas));
    }

    function UpdateZoo($id, ZooEntity $Zoo) {
        require 'Credentials.php';
        $dbh = new PDO('mysql:host=localhost;dbname=zoodb;charset=utf8', $user, $passwd, array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
        ));
        $query = "UPDATE gyvunai
                            SET pavadinimas = :pavadinimas, rusis = :rusis, porusis = :porusis, mokslinis_pavadinimas = :mokslinis_pavadinimas,
                            paplitimas = :paplitimas, paveikslelis = :paveikslelis, aprasymas = :aprasymas
                          WHERE id = :id";
            $stmt = $dbh->prepare($query);
            $stmt->execute(array(':id'=>$Zoo->id,
                ':pavadinimas'=>$Zoo->pavadinimas,
            ':rusis'=>$Zoo->rusis,
            ':porusis'=>$Zoo->porusis,
            ':mokslinis_pavadinimas'=>$Zoo->mokslinis_pavadinimas,
            ':paplitimas'=>$Zoo->paplitimas,
            ':paveikslelis'=>$Zoo->paveikslelis,
            ':aprasymas'=>$Zoo->aprasymas));

    }

    function DeleteZoo($id) {
        $query = "DELETE FROM gyvunai WHERE id = $id";
        $this->PerformQuery($query);
    }

    function PerformQuery($query) {
        require ('Credentials.php');
        $dbh = new PDO('mysql:host=localhost;dbname=zoodb;charset=utf8', $user, $passwd, array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
        ));

        $stmt = $dbh->prepare($query);
        $stmt->execute();
    }

}

?>
