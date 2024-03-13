<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

include_once 'Impianto.php';
include_once 'Rilevatore.php';
include_once 'RilevatoreDiTemperatura.php';
include_once 'RilevatoreDiUmidita.php';

class ImpiantoController{

    function mostraDati(Request $request, Response $response, $args){
        $impianto = new Impianto();
        $response->getBody()->write(json_encode($impianto));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
                  
    }

}


?>