<?php

include('../../global.inc.php');
include('../../db.inc.php');

// logged in?
if(!$loggedIn) {
    header('Location: '.$rootUrl.'auth/');
    exit;
}

try {
    $sql = "DELETE 
                FROM posts
                WHERE slug = :slug
                ";

    $statement = $connection->prepare($sql);
    $statement->bindParam(':slug', $_GET['id'], PDO::FETCH_ASSOC);
    $statement->execute();

} catch(PDOException $error) {
    $err = $error->getMessage();
}

if(!isset($error)) {
    $result = array("error" => "ok");
}else {
    $result = array("error" => $err);
}

header('Content-Type: application/json');

if ($_GET['pp']) {
    echo json_encode($result, JSON_PRETTY_PRINT);
} else {
    echo json_encode($result);
}
?>