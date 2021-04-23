<?php

    require('config/connect.php');

    $sql = 'SELECT * FROM posts';
    $query = $pdo->prepare($sql);
    $query->execute();
    $posts = $query->fetchAll();

?>

<?php include('includes/header.php')?>
    <section class="container">
        <?php
            if (isset($_GET['signup'])) {
                $msg = $_GET['signup'];
                if ($msg == 'success') {
                    echo '<div class="msg-container"><p class="msg confirm-msg">You\'ve successfully signed up.</p></div>';
                }
            } else if (isset($_GET['login'])) {
                $msg = $_GET['login'];
                if ($msg == 'success') {
                    echo '<div class="msg-container"><p class="msg confirm-msg">You\'ve successfully logged in.</p></div>';
                } else if ($msg = 'error') {
                    echo '<div class="msg-container"><p class="msg error-msg">Error logging in.</p></div>';
                }
            }
            
        ?>
<?php 

// gets topic id
if (!isset($topic_id)) {
    $topic_id = filter_input(INPUT_GET, 'topic_id', FILTER_VALIDATE_INT);
    if ($topic_id == NULL || $topic_id == FALSE) {
    $topic_id = 1;
    }
    }

    // name for current topic
    $querytopic = "SELECT * FROM topics WHERE topicID = :topic_id";
    $statement1 = $pdo->prepare($querytopic);
    $statement1->bindValue('topic_id', $topic_id);
    $statement1->execute();
    $topic = $statement1->fetch();
    $statement1->closeCursor();
    $topic_name = $topic['topicName'];


    //get all topics
    $queryAlltopics = 'SELECT * FROM topics ORDER BY topicID';
    $statement2 = $pdo->prepare($queryAlltopics);
    $statement2->execute();
    $topics = $statement2->fetchAll();
    $statement2->closeCursor();


    //get posts from selected topic
    $queryposts = "SELECT * FROM posts WHERE topicID = :topic_id ORDER BY id";
    $statement3 = $pdo->prepare($queryposts);
    $statement3->bindValue(':topic_id', $topic_id);
    $statement3->execute();
    $posts = $statement3->fetchAll();
    $statement3->closeCursor();
    




?>
<aside>


<nav>
<ul>
<div class="dropdown">
<button class="dropbtn">Topics</button>
<div class="dropdown-content">
<?php foreach($topics as $topic) : ?>


<a href=".?topic_id=<?php echo $topic['topicID']; ?>">
<?php echo $topic['topicName']; ?>
</a>

<?php endforeach; ?>
</div>
</div>
</ul>
</nav>
</aside>


    <a href="<?php echo ROOT_URL?>addpost.php" class="btn btn-submit">Add New Post</a>

    <!-- display table of posts -->
        <h1>Posts</h1>
        <h2><?php echo $topic_name; ?></h2>
        <?php foreach($posts as $post) : ?>
            <div class="blog-post">
                <h3><?php echo $post['title']; ?></h3>
                <small>Posted on <?php echo $post['created_at']?> by <?php echo $post['author']; ?></small>
                <p><?php echo $post['body']; ?></p>
                
                <a href="<?php echo ROOT_URL?>post.php?id=<?php echo $post['id'];?>" class="btn btn-primary">Read</a>
            </div>
        <?php endforeach; ?>
    </section> 
<?php include('includes/footer.php')?>