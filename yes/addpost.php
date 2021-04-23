<?php
    
    require('config/connect.php');

    session_start();

    if (!isset($_SESSION['username'])) {
        header('Location: index.php');
        exit();
    }

    if(isset($_POST['submit'])){
        $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
        $body = filter_var($_POST['body'], FILTER_SANITIZE_SPECIAL_CHARS);
        $author = filter_var($_SESSION['username'], FILTER_SANITIZE_STRING);
        $topic_id = filter_var($_POST['topic_id'], FILTER_VALIDATE_INT); 
        
    
        $sql = "INSERT INTO posts(topicID, title, author, body) VALUES (:topic_id, :title, :author, :body)";
        $query = $pdo->prepare($sql);
        $query->execute(['title' => $title, 'author' => $author, 'body' => $body, 'topic_id' => $topic_id]);
        
        header('Location: ' . ROOT_URL . "");
    }

    $query1 = 'SELECT * FROM topics ORDER BY topicID';
    $statement = $pdo->prepare($query1);
    $statement->execute();
    $topics = $statement->fetchAll();
    $statement->closeCursor();

?>

<?php include('includes/header.php')?>
    <div class="container">
        <h1>Add Post</h1>
        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
            
                <label>Topic</label>
                <select name="topic_id">
                <?php foreach ($topics as $topic) : ?>
                <option value="<?php echo $topic['topicID']; ?>">
                    <?php echo $topic['topicName']; ?>
                </option>
                <?php endforeach; ?>
                </select>
                
            <div class="form-group">
                <label>Title</label>
                <input type="text" class="form-input" name="title" >
            </div>

            <div class="form-group">
                <label>Body</label>
                <input type="text" class="form-input" name="body" >
            </div>
            
            
            <input type="submit" class="btn btn-submit" value="Submit" name="submit">
            <a href="<?php echo ROOT_URL; ?>" class="btn btn-primary">Back</a>
        </form>
    </div> 
<?php include('includes/footer.php')?>