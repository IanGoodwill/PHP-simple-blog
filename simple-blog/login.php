<?php
session_start();
include './nav.php';

$username = 'wolftron';
$password = 'securepass99';

// check for form submission
if ( isset( $_POST ) ) {
    // check if username and password is correct.
    if ( ($username === $_POST['username']  ) && ( $password === $_POST['password']) ) {
        // we are logged in
        $_SESSION['logged_in'] = TRUE;
        $_SESSION['username'] = $username;
        header( 'location: index.php');
    } else {
        $message = 'Username or Password was incorrect. Please try again.';
    }
}
    
?><!DOCTYPE html>

<html>
    <head>
        <title> Login Page </title>
        <link rel="stylesheet" type="text/css" href="./css/main.css">
    </head>
    <body>

        <h1>Login Page!</h1>

        <p>
            <?php
                echo $message;
            ?>
        </p>

        <form action="#" method="POST">
            <label for="username"> 
                Username:
                <input type="text" placeholder= "Enter your username..."name="username" title="Enter your username!">
            </label>
            <label for="password"> 
                Password:
                <input type="password" placeholder= "Enter your password..." name="password" title="Enter your password here!">
            </label>
            <input type="submit" name ="submit" value="submit">
        </form>

    </body>

</html>