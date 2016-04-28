<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

$app->get('/api/posts', function (Request $request, Response $response) {

    $sql = "SELECT * FROM posts";

    try{
        //Gets DB object
        $db = new DB();
        //Connection
        $dbConnection = $db->connect();

        $stmt = $dbConnection->query($sql);
        $posts = $stmt->fetchAll(PDO::FETCH_OBJ);

        echo json_encode($posts);
    }catch (PDOException $e){
        echo '{"error": {"text":' . $e->getMessage() . '}}';
    }

});