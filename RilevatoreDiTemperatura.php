<?php

class RilevatoreDiTemperatura extends Rilevatore implements jsonSerializable{
    private $tipologia;
    private $unitaDiMisura;

    function __construct($identificativo,$codiceSeriale,$tipologia){
        parent::__construct($identificativo,$codiceSeriale);
        $this->tipologia = $tipologia;
        $unitaDiMisura = "Celsius";
    }


    function jsonSerialize(){
        return [
            "identificativo" => $this->identificativo,
            "codiceSeriale" => $this->codiceSeriale,
            "posizione" => $this->posizione,
            "unitaDiMisura" => $this->unitaDiMisura
        ];
    }
}


?>