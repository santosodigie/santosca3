<?php
    require_once('login-connect');

    $query = 'SELECT * FROM topics ORDER BY topic_id';
    $statement = $db->prepare($query);
    $statement->execute();
    $topics = $statement->fetchAll();
    $statement->closeCursor();
?>