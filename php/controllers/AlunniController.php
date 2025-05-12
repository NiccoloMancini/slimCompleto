<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AlunniController{
  public function index(Request $request, Response $response, $args){
    sleep(3);
    $result = Db::getInstance()->select("alunni");
    $response->getBody()->write(json_encode($result));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

  public function show(Request $request, Response $response, $args){
    $result = Db::getInstance()->select("alunni", "id = " . $args['id']);
    $response->getBody()->write(json_encode($result));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

  public function create(Request $request, Response $response, $args){
    $body = json_decode($request->getBody()->getContents(), true);
    $nome = $body["nome"];
    $cognome = $body["cognome"];
    $result = Db::getInstance()->query("INSERT INTO alunni (nome, cognome) VALUES ('$nome', '$cognome')");
    $response->getBody()->write(json_encode($result));
    return $response->withHeader("Content-type", "application/json")->withStatus(201);
  }

  public function update(Request $request, Response $response, $args){
    $body = json_decode($request->getBody()->getContents(), true);
    $nome = $body["nome"];
    $cognome = $body["cognome"];
    $result = Db::getInstance()->query("UPDATE alunni SET nome = '$nome', cognome = '$cognome' WHERE id = " . $args['id']);
    $response->getBody()->write($result ? "aggiornamento effettuato" : "errore");
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

  public function delete(Request $request, Response $response, $args){
    $result = Db::getInstance()->query("DELETE FROM alunni WHERE id = " . $args['id']);
    $response->getBody()->write($result ? "eliminazione avvenuta con successo" : "errore");
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }
}
