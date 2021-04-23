<?php
// Get id
$user_id = filter_input(INPUT_POST, 'user_id', FILTER_VALIDATE_INT);

if($user_id == null || $user_id == false)
{
    $error = "Invalid user ID";
}
else
{
    require_once('config/connect.php');

    //query to delete the products from the database
    $query = 'DELETE FROM users WHERE id = :user_id';
    $statement = $pdo->prepare($query);
    $statement->bindValue(':user_id', $user_id);
    $statement->execute();
    $statement->closeCursor();

    //update
    include('adminpage.php');

}

?>