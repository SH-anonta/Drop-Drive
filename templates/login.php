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

        <div id="ErrorListContainer">
            <ul id="ErrorList"></ul>
        </div>

        <h3>Login</h3>
        <form id="LoginForm" action="/filehost/login" method="POST">
            <input type="text" placeholder="User name" name="user_name">
            <br>
            <input type="password" placeholder="Password" name="password">
            <br>
            <button type="submit">Login</button>
        </form>
    </body>

<script type="text/javascript" src="/filehost/static/script/login_validation.js"></script>

</html>