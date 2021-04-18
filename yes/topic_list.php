<?php
    require_once('login_connect.php');

    $query = 'SELECT * FROM topics ORDER BY topic_id';
    $statement = $pdo->prepare($query);
    $statement->execute();
    $topics = $statement->fetchAll();
    $statement->closeCursor();
?>

<!-- the head section --> 
<?php
include('includes/header.php');
?>

<h1>Forums</h1>
    <table>
        <tr>
            <th>Name</th>
            <th>&nbsp;</th>
        </tr>
        <?php foreach ($topics as $topic) : ?>
        <tr>
            <td><?php echo $topic['TopicName']; ?></td>
            <td>
            <form action="delete_topic.php" method="post" id="delete_product_form">
            <input type="hidden" name="topic_id" value="<?php echo $topic['topic_id']; ?>">
            <input class="btn" type="submit" value="Delete">
            </form>
            </td>
        </tr>
        <?php endforeach; ?>
        </table>
        <br>

        <h2>Add Topic</h2>
        <form action="add_topic.php" method="post" id="add_topic_form">

        <label>New Topic:</label>
        <input type="input" name="name">
        <input class="btn" id="add_topic_button" type="submit" value="Add">
        </form>
        <br>
        <p><a href="index.php">Homepage</a></p>
        
