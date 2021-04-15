<?php
// Get the topic data
$name = $name = filter_input(INPUT_POST, 'name');

// Validate inputs
if ($name == null) {
    $error = "Invalid topic data. Check all fields and try again.";
    include('error.php');
} else {
    require_once('login.php');

    // Add the product to the database
    $query = "INSERT INTO topics (TopicName)
              VALUES (:name)";
    $statement = $db->prepare($query);
    $statement->bindValue(':name', $name);
    $statement->execute();
    $statement->closeCursor();

    // Display the Category List page
    include('topic_list.php');
}
?>