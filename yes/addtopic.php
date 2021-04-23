<?php

$name = $name = filter_input(INPUT_POST, 'name');

if($name == null)
{
    $error = "Invalid Topic Data check all fields and try again.";
}else{
    require_once 'config/connect.php';

    $query = "INSERT INTO topics (topicName) VALUES (:name)";
    $statement = $pdo->prepare($query);
    $statement->bindValue(':name', $name);
    $statement->execute();
    $statement->closeCursor();

    include('topiclist.php');
}
?>