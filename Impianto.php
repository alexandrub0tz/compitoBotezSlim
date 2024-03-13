<?php

class Impianto implements JsonSerializable{
    private $nome;
    private $latitudine;
    private $longitudine;
    private $rilevatori = array();

    function __construct(){
        $this->nome = "impianto1";
        $this->latitudine = "32";
        $this->longitudine = "11";
        $this->rilevatori = [
            new RilevatorediUmidita("1","AFS","terra"), 
            new RilevatoreDiTemperatura("2","ASDSA","acqua"),
            new RilevatorediUmidita("3","zzzz","acqua")
        ];
    }

    function aggiungiRilevatore($rilevatore){
        array_push($this->rilevatori, $rilevatore);
    }

    function getRilevatori(){
        return $this->rilevatori;
    }


    function mostraMisurazioniMaggiori($valore){
        $misurazioniMaggiore = array();

        foreach($this->rilevatori as $rilevatore){
            if($rilevatore->getMisurazioni()["valore"] > $valore){
                array_push($misurazioniMaggiore, $rilevatore->getMisurazioni());
            }
        }

        return $misurazioniMaggiore;
    }


    function aggiornaRilevatore($rilevatore){

        foreach($this->rilevatori as $r){
            if($r->getIdentificativo() == $rilevatore["identificativo"]){
                $r->setCodiceSeriale($rilevatore["codiceSeriale"]);
                $r->setPosizione($rilevatore["posizione"]);
            }
        }
    }



    function jsonSerialize(){
        return [
            "nome" => $this->nome,
            "latitudine" => $this->latitudine,
            "longitudine" => $this->longitudine,
        ];
    }


}



?>