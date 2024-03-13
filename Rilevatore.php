<?php

class Rilevatore{
    protected $identificativo;
    protected $misurazioni = array();
    protected $codiceSeriale;

    function __construct($identificativo,$codiceSeriale){
        $this->identificativo = $identificativo;
        $this->codiceSeriale = $codiceSeriale;
        $this->misurazioni = ["data"=>date("Y-m-d H:i:s"),"valore"=>"24"];
    }


    function setCodiceSeriale($codiceSeriale){
        $this->codiceSeriale = $codiceSeriale;
    }

    function setPosizione($posizione){
        $this->posizione = $posizione;
    }

    function getIdentificativo(){
        return $this->identificativo;
    }

    function getMisurazioni(){
        return $this->misurazioni;
    }

}








?>