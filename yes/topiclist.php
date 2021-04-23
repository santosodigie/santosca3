<?php
    require_once('config/connect.php');

    // all topics
    $query = 'SELECT * FROM topics ORDER BY topicID';
    $statement = $pdo->prepare($query);
    $statement->execute();
    $topics = $statement->fetchAll();
    $statement->closeCursor();
?>

<?php include('includes/header.php')?>
<div class ="container">

    <h1>Topics</h1>
    <table>
        <tr>
            <th>Topic</th>
            <th>&nbsp;</th>
        </tr>
        <?php foreach ($topics as $topic) : ?>
        <tr>
            <td><?php echo $topic['topicName']; ?></td>
            <td>
                <form action="deletetopic.php" method="post" id="delete_product_form">
                <input type="hidden" name="topic_id" value="<?php echo $topic['topicID']; ?>">
                <input class="btn" type="submit" value="Delete">
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <br>

    <h2>Add Topic</h2>
    <form action="addtopic.php" method="post" id="add_topic_form">
            <label>Name:</label>
            <input type="input" name="name">
            <input class="btn" id="add_category_button" type="submit" value="Add">
    </form>
    <br>
    <p><a href="index.php">Homepage</a></p>
