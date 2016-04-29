<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

//Gets all categories
$app->get('/api/categories', function (Request $request, Response $response) {

    $sql = "SELECT * FROM categories";

    try{
        //Gets DB object
        $db = new DB();
        //Connection
        $dbConnection = $db->connect();

        $stmt = $dbConnection->query($sql);
        $categories = $stmt->fetchAll(PDO::FETCH_OBJ);

        echo json_encode($categories);
    }catch (PDOException $e){
        echo '{"error": {"text":' . $e->getMessage() . '}}';
    }

});

//Gets single category
$app->get('/api/category/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $sql = "SELECT * FROM categories WHERE id = $id";

    try{
        //Gets DB object
        $db = new DB();
        //Connection
        $dbConnection = $db->connect();

        $stmt = $dbConnection->query($sql);
        $categories = $stmt->fetchAll(PDO::FETCH_OBJ);

        echo json_encode($categories);
    }catch (PDOException $e){
        echo '{"error": {"text":' . $e->getMessage() . '}}';
    }

});

//Adds category
$app->post('/api/category/add', function (Request $request, Response $response) {
    $name = $request->getParam('name');

    $sql = "INSERT INTO categories (name) VALUES (:name)";

    try{
        //Gets DB object
        $db = new DB();
        //Connection
        $dbConnection = $db->connect();

        $stmt = $dbConnection->prepare($sql);
        $stmt->bindParam(':name', $name);

        $stmt->execute();

        echo '{"notice": {"text": "Category Added"}}';

    }catch (PDOException $e){
        echo '{"error": {"text":' . $e->getMessage() . '}}';
    }

});

//Updates category
$app->put('/api/category/update/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');

    $name = $request->getParam('name');

    $sql = "UPDATE categories SET name = :name
                         WHERE id = $id";

    try{
        //Gets DB object
        $db = new DB();
        //Connection
        $dbConnection = $db->connect();

        $stmt = $dbConnection->prepare($sql);
        $stmt->bindParam(':name', $name);

        $stmt->execute();

        echo '{"notice": {"text": "Category ' . $id .' is Updated"}}';

    }catch (PDOException $e){
        echo '{"error": {"text":' . $e->getMessage() . '}}';
    }

});

//Deletes category
$app->delete('/api/category/delete/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');

    $sql = "DELETE FROM categories WHERE id = $id";

    try{
        //Gets DB object
        $db = new DB();
        //Connection
        $dbConnection = $db->connect();

        $stmt = $dbConnection->prepare($sql);
        $stmt->execute();

        echo '{"notice": {"text": "Category ' . $id .' is Deleted"}}';

    }catch (PDOException $e){
        echo '{"error": {"text":' . $e->getMessage() . '}}';
    }

});