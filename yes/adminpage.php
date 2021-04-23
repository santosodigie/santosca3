<?php
    require_once('config/connect.php');

    //Get all users information
    $query = 'SELECT * FROM users ORDER BY id';
    $statement = $pdo->prepare($query);
    $statement->execute();
    $users = $statement->fetchAll();
    $statement->closeCursor();

?>

<?php include('includes/header.php')?>
<div class="container">


<h1>User List<h1>
<div class="table-wrapper">
<table class="fl-table">
    <thead>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th></th>
      
    </tr>
    </thead>
    <?php foreach ($users as $user) : ?>
    <tbody>
    <tr>
        <td><?php echo $user['username']; ?></td>
        <td><?php echo $user['email']; ?></td>
        <td>
            <form action="deleteuser.php" method="post" id="deleteuserform">
                <input type="hidden" name="user_id" value ="<?php echo $user['id']; ?>">
                <input class="btn" type="submit" value="Delete">
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</div>
<br>