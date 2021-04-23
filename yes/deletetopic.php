<?php

$topic_id = filter_input(INPUT_POST, 'topic_id', FILTER_VALIDATE_INT);

if($topic_id == null || $topic_id == false)
{
    $error = "Invalid topic ID";
} else{
    require_once 'config/connect.php';

    $query = 'DELETE FROM topics WHERE topicID = :topic_id';
    $statement = $pdo->prepare($query);
    $statement->bindValue(':topic_id', $topic_id);
    $statement->execute();
    $statement->closeCursor();

    include('topiclist.php');
}
?>