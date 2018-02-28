<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Login</title>
    </head>
    
    <body>
        <?php
            // show header
            require('fragments/header.php');
        ?>

        <form action="/filehost/login" method="POST">
            <input required type="text" placeholder="User name" name="user_name">
            <br>
            <input required type="password" placeholder="Password" name="password">
            <br>
            <button type="submit">Login</button>
        </form>
    </body>
</html>