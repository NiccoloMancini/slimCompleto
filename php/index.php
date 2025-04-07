<?php
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/controllers/AlunniController.php';
require __DIR__ . '/controllers/CertificazioniController.php';
require __DIR__ . '/includes/Db.php';


$app = AppFactory::create();

//curl http://localhost:8080/alunni
$app->get('/alunni', "AlunniController:index");
//curl http://localhost:8080/alunni/2
$app->get('/alunni/{id}', "AlunniController:show");
//curl -X POST http://localhost:8080/alunni -H "Content-Type: application/json" -d '{"nome": "niccolo", "cognome": "mancini"}'
$app->post('/alunni', "AlunniController:create");
//curl PUT http://localhost:8080/alunni/2 -H "Content-Type: application/json" -d '{"nome": "niccolo", "cognome": "mancini"}'
$app->put('/alunni/{id}', "AlunniController:update");
$app->delete('/alunni/{id}', "AlunniController:delete");

//curl http://localhost:8080/alunni
$app->get('/certificazioni', "CertificazioniController:index");
//curl http://localhost:8080/alunni/2/certificazioni
$app->get('/alunni/{id_alunno}/certificazioni', "CertificazioniController:index");

//curl http://localhost:8080/certificazioni/2
$app->get('/certificazioni/{id_certificazioni}', "CertificazioniController:show");
//curl http://localhost:8080/alunni/2/certificazioni/2
$app->get('/alunni/{id_alunno}/certificazioni/{id_certificazioni}', "CertificazioniController:show");

//curl -X POST http://localhost:8080/certificazioni -H "Content-Type: application/json" -d '{"nome": "niccolo", "cognome": "mancini"}'
$app->post('/certificazioni', "CertificazioniController:create");
//curl -X POST http://localhost:8080/alunni/2/certificazioni -H "Content-Type: application/json" -d '{"nome": "niccolo", "cognome": "mancini"}'
$app->post('/alunni/{id_alunno}/certificazioni/{id_certificazioni}', "CertificazioniController:create");

//curl PUT http://localhost:8080/certificazioni/2 -H "Content-Type: application/json" -d '{"nome": "niccolo", "cognome": "mancini"}'
$app->put('/certificazioni/{id_certificazioni}', "CertificazioniController:update");
//curl PUT http://localhost:8080/alunni/2/certificazioni/2 -H "Content-Type: application/json" -d '{"nome": "niccolo", "cognome": "mancini"}'
$app->put('/alunni/{id_alunno}/certificazioni/{id_certificazioni}', "CertificazioniController:update");

//curl -X DELETE http://localhost:8080/certificazioni/2
$app->delete('/certificazioni/{id_certificazioni}', "CertificazioniController:delete");
//curl -X DELETE http://localhost:8080/alunni/2/certificazioni/2
$app->delete('/alunni/{id_alunno}/certificazioni/{id_certificazioni}', "CertificazioniController:delete");

$app->run();
