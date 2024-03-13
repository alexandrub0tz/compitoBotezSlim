<?php


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

include_once 'Impianto.php';
include_once 'Rilevatore.php';
include_once 'RilevatoreDiTemperatura.php';
include_once 'RilevatoreDiUmidita.php';

class RilevatoreController {

    function mostraRilevatoriUmidita(Request $request, Response $response, array $args) {
        $impianto = new Impianto();
        $rilevatoriUmidita = array();
        
        foreach($impianto->getRilevatori() as $rilevatore){
            if($rilevatore instanceof RilevatoreDiUmidita){
                array_push($rilevatoriUmidita, $rilevatore);
            }
        }

        if(empty($rilevatoriUmidita)){
            return $response->withStatus(404);
        }

        $response->getBody()->write(json_encode($rilevatoriUmidita));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);

   

    }

    function mostraDati(Request $request, Response $response, $args){
        $impianto = new Impianto();


        foreach($impianto->getRilevatori() as $rilevatore){
            if($rilevatore->getIdentificativo() == $args["identificativo"] && $rilevatore instanceof RilevatoreDiUmidita){
                $response->getBody()->write(json_encode($rilevatore));
                return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
            }
        }

        return $response->withStatus(404);

    }



    function mostraMisurazioni(Request $request, Response $response, $args){
        $impianto = new Impianto();

        foreach($impianto->getRilevatori() as $rilevatore){
            if($rilevatore->getIdentificativo() == $args["identificativo"] && $rilevatore instanceof RilevatoreDiUmidita){
                $response->getBody()->write(json_encode($rilevatore->getMisurazioni()));
                return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
            }
        }
    }

    function mostraMisurazioneMaggiori(Request $request, Response $response, $args){
        $impianto = new Impianto();
        $minimo = $args["valore_minimo"];
        if($impianto->mostraMisurazioniMaggiori($minimo) == null){
            return $response->withStatus(404);
        } else {
            $response->getBody()->write(json_encode($impianto->mostraMisurazioniMaggiori($minimo)));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
        }
    }


    function creaNuovoRilevatore(Request $request, Response $response, $args){
        $impianto = new Impianto();
        $contents = $request->getBody()->getContents();
        $parsedbody = json_decode($contents,true);

        $rilevatore = new RilevatoreDiUmidita($parsedbody["identificativo"],$parsedbody["codiceSeriale"],$parsedbody["posizione"]);
        $impianto->aggiungiRilevatore($rilevatore);
    }


    function aggiornaRilevatore(Request $request, Response $response, $args){

        $impianto = new Impianto();
        $contents = $request->getBody()->getContents();
        $parsedbody = json_decode($contents,true);
        $impianto->aggiornaRilevatore($parsedbody["identificativo"],$parsedbody["codiceSeriale"],$parsedbody["posizione"]);
    }


    function mostraDatiTemperatura(Request $request, Response $response, $args){
        $impianto = new Impianto();
        $rilevatoriTemperatura = array();
        
        foreach($impianto->getRilevatori() as $rilevatore){
            if($rilevatore instanceof RilevatoreDiTemperatura){
                array_push($rilevatoriTemperatura, $rilevatore);
            }
        }

        if(empty($rilevatoriTemperatura)){
            return $response->withStatus(404);
        }

        $response->getBody()->write(json_encode($rilevatoriTemperatura));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }


    function mostraRilevatoriTemperatura(Request $request, Response $response, $args){
        $impianto = new Impianto();


        foreach($impianto->getRilevatori() as $rilevatore){
            if($rilevatore->getIdentificativo() == $args["identificativo"] && $rilevatore instanceof RilevatoreDiTemperatura){
                $response->getBody()->write(json_encode($rilevatore));
                return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
            }
        }

        return $response->withStatus(404);
        
    }

}



?>