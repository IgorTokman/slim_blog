<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

//Gets all posts
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

//Gets single post
$app->get('/api/post/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $sql = "SELECT * FROM posts WHERE id = $id";

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

//Adds post
$app->post('/api/post/add', function (Request $request, Response $response) {
    $title = $request->getParam('title');
    $category_id = $request->getParam('category_id');
    $body = $request->getParam('body');

    $sql = "INSERT INTO posts (title, category_id, body) VALUES (:title, :category_id, :body)";

    try{
        //Gets DB object
        $db = new DB();
        //Connection
        $dbConnection = $db->connect();

        $stmt = $dbConnection->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':body', $body);

        $stmt->execute();

       echo '{"notice": {"text": "Post Added"}}';
        
    }catch (PDOException $e){
        echo '{"error": {"text":' . $e->getMessage() . '}}';
    }

});

//Updates post
$app->put('/api/post/update/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');

    $title = $request->getParam('title');
    $category_id = $request->getParam('category_id');
    $body = $request->getParam('body');

    $sql = "UPDATE posts SET title = :title, 
                             category_id = :category_id, 
                             body = :body 
                         WHERE id = $id";

    try{
        //Gets DB object
        $db = new DB();
        //Connection
        $dbConnection = $db->connect();

        $stmt = $dbConnection->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':body', $body);

        $stmt->execute();

       echo '{"notice": {"text": "Post ' . $id .' is Updated"}}';

    }catch (PDOException $e){
        echo '{"error": {"text":' . $e->getMessage() . '}}';
    }

});

//Deletes post
$app->delete('/api/post/delete/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');

    $sql = "DELETE FROM posts WHERE id = $id";

    try{
        //Gets DB object
        $db = new DB();
        //Connection
        $dbConnection = $db->connect();

        $stmt = $dbConnection->prepare($sql);
        $stmt->execute();

       echo '{"notice": {"text": "Post ' . $id .' is Deleted"}}';

    }catch (PDOException $e){
        echo '{"error": {"text":' . $e->getMessage() . '}}';
    }

});