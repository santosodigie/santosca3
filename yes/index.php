<?php   


require 'login_connect.php';

if(!isset($topic_id)) {
    $topic_id = filter_input(INPUT_GET, 'topic_id', FILTER_VALIDATE_INT);
    if($topic_id == NULL || $topic_id == FALSE) {
        $topic_id =1;
    }
}

$querytopic = "SELECT * FROM topics WHERE topic_id = :topic_id";
$statement1 = $pdo->prepare($querytopic);
$statement1->bindvalue('topic_id', $topic_id);
$statement1->execute();
$topic = $statement1->fetch();
$statement1->closeCursor();
$topic_name = $topic['TopicName'];

// Get all topics
$queryAlltopics = 'SELECT * FROM topics ORDER BY topic_id';
$statement2 = $pdo->prepare($queryAlltopics);
$statement2->execute();
$topics = $statement2->fetchAll();
$statement2->closeCursor();

// Get posts for selected topics
$queryposts = "SELECT * FROM posts WHERE topic_id = :topic_id ORDER BY post_id";
$statement3 = $pdo->prepare($queryposts);
$statement3->bindValue(':topic_id', $topic_id);
$statement3->execute();
$posts = $statement3->fetchAll();
$statement3->closeCursor();
?>
<?php
include('includes/header.php');
?>

<h1>Posts</h1>

<aside>





