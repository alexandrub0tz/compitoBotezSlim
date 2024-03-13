<?php

class RilevatoreDiUmidita extends Rilevatore implements JsonSerializable {
    private $posizione;
    private $unitaDiMisura;
    

    function __construct($identificativo,$codiceSeriale,$posizione){
        parent::__construct($identificativo,$codiceSeriale);
        $this->posizione = $posizione;
        $this->unitaDiMisura = "percentuale";
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