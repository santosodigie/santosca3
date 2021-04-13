<?php

//register.php

/**
 * Start the session.
 */
session_start();

/**
 * Include ircmaxell's password_compat library.
 */
require 'libary-folder/password.php';

/**
 * Include our MySQL connection.
 */
require 'login_connect.php';


//If the POST var "register" exists (our submit button), then we can
//assume that the user has submitted the registration form.
if(isset($_POST['register'])){
    
    //Retrieve the field values from our registration form.
    $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
    $pass = !empty($_POST['password']) ? trim($_POST['password']) : null;
    $email = !empty($_POST['email']) ? trim($_POST['email']) : null;
    $dob = !empty($_POST['dob']) ? trim($_POST['dob']) : null;
    
    //TO ADD: Error checking (username characters, password length, etc).
    //Basically, you will need to add your own error checking BEFORE
    //the prepared statement is built and executed.
    
    //Now, we need to check if the supplied username already exists.
    
    //Construct the SQL statement and prepare it.
    $sql = "SELECT COUNT(username) AS num FROM users WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    
    //Bind the provided username to our prepared statement.
    $stmt->bindValue(':username', $username);
    
    
    //Execute.
    $stmt->execute();
    
    //Fetch the row.
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    //If the provided username already exists - display error.
    //TO ADD - Your own method of handling this error. For example purposes,
    //I'm just going to kill the script completely, as error handling is outside
    //the scope of this tutorial.
    if($row['num'] > 0){
        die('That username already exists!');
    }
    
    //Hash the password as we do NOT want to store our passwords in plain text.
    $passwordHash = password_hash($pass, PASSWORD_BCRYPT, array("cost" => 12));
    
    //Prepare our INSERT statement.
    //Remember: We are inserting a new row into our users table.
    $sql = "INSERT INTO users (username, password, email, dob) VALUES (:username, :password, :email, :dob)";
    $stmt = $pdo->prepare($sql);
    
    //Bind our variables.
    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':password', $passwordHash);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':dob', $dob);

    //Execute the statement and insert the new account.
    $result = $stmt->execute();
    
    //If the signup process is successful.
    if($result){
        //What you do here is up to you!
        echo 'Thank you for registering with our website.';
    }
    
}

?>
<!DOCTYPE html>
<?php
include('includes/header.php');
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/mystyle.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">  
        <title>Register</title>
    </head>
    <body>
        
        <form action="register.php" method="post">
        <h4 class="text-warning text-center pt-5">Registration Page.</h4>

            <label for="username">
                <input 
                type="text" 
                class="input" 
                id="username" 
                name="username" 
                placeholder="USERNAME">
                <div class="line-box">          
                    <div class="line"></div>        
                </div>
            </label>    
            

            <label for="password">
                <input 
                type="text"
                class="input"
                id="password" 
                name="password"
                placeholder="PASSWORD">
                <div class="line-box">          
                <div class="line"></div>        
                </div>
            </label>  
            

            <label for="email">
                <input 
                type="text" 
                class="input"
                id="email" 
                name="email"
                placeholder="EMAIL">
                    <div class="line-box">          
                    <div class="line"></div>        
                    </div>
            </label>  
            

            <label for="dob">
                <input 
                type="text"
                class="input" 
                id="dob" 
                name="dob"
                placeholder="DATE OF BIRTH">
                    <div class="line-box">          
                    <div class="line"></div>        
                    </div>
            </label>  
            

            <button type="submit" name="register" value="Register">Register</button>
        </form>
    </body>
</html>