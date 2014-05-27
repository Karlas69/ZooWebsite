<?php

class ZooEntity
{
    public $id;
    public $pavadinimas;
    public $rusis;
    public $porusis;
    public $mokslinis_pavadinimas;
    public $paplitimas;
    public $paveikslelis;
    public $aprasymas;
    
    function __construct($id, $pavadinimas, $rusis, $porusis, $mokslinis_pavadinimas, $paplitimas, $paveikslelis, $aprasymas) {
        $this->id = $id;
        $this->pavadinimas = $pavadinimas;
        $this->rusis = $rusis;
        $this->porusis = $porusis;
        $this->mokslinis_pavadinimas = $mokslinis_pavadinimas;
        $this->paplitimas = $paplitimas;
        $this->paveikslelis = $paveikslelis;
        $this->aprasymas = $aprasymas;
    }


}

?>
