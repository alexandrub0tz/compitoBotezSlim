<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';

include_once 'ImpiantoController.php';
include_once 'RilevatoreController.php';

$app = AppFactory::create();

$app->get('/impianto','ImpiantoController:mostraDati');
$app->get('/rilevatori_di_umidita','RilevatoreController:mostraRilevatoriUmidita');
$app->get('/rilevatori_di_umidita/{identificativo}','RilevatoreController:mostraDati');
$app->get('/rilevatori_di_umidita/{identificativo}/misurazioni','RilevatoreController:mostraMisurazioni');
$app->get('/rilevatori_di_umidita/{identificativo}/misurazioni/maggiore_di/{valore_minimo}','RilevatoreController:mostraMisurazioneMaggiori');
$app->post('/rilevatori_di_umidita/','RilevatoreController:creaNuovoRilevatore');
$app->put('/rilevatori_di_umidita/{identificativo}','RilevatoreController:aggiornaRilevatore');

$app->get('/rilevatori_di_temperatura','RilevatoreController:mostraDatiTemperatura');
$app->get('/rilevatori_di_temperatura/{identificativo}','RilevatoreController:mostraRilevatoriTemperatura');
$app->get('/rilevatori_di_temperatura/{identificativo}/misurazioni','RilevatoreController:mostraMisurazioniTemperature');

$app->run();
