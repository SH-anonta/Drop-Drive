<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Register</title>
        <link rel="stylesheet" href="/filehost/static/style/global.css">
    </head>
    
    <body>
        <?php
            // show header
            require('fragments/header.php');
        ?>

        <h3>Register</h3>

        <?php
            // if error messages were set, show them in list format
            if(!empty($_registeration_error_list)){
                echo '<ul>';
                foreach($_registeration_error_list as $err_msg){
                    printf('<li>%s</li>', $err_msg);
                }
                echo '</ul>';
            }
        ?>

        <?php
            //this form assumes 4 variables to be set before being executed
            // the forms' input elements use these variables to assign defailt value (value attribute)
            // uname, email, pw, confirm_pw

            if(!isset($uname))
                $uname = '';
            if(!isset($email))
                $email = '';
            if(!isset($pw))
                $pw = '';
            if(!isset($confirm_pw))
                $confirm_pw = '';

        ?>
        <ul id="error_msg"></ul>

        <form id="RegisterForm" action="/filehost/register" method="POST">
            <input type="text" placeholder="User name" name="user_name" value="<?php echo $uname?>">
            <br>
            <input type="email" placeholder="Email" name="email" value="<?php echo $email?>">
            <br>
            <input type="password" placeholder="Password" name="password"  value="<?php echo $pw?>">
            <br>
            <input type="password" placeholder="Confirm Password" name="confirm_password" value="<?php echo $confirm_pw?>">
            <br>
            <button type="submit">Register</button>
        </form>


    <script type="text/javascript" src="/filehost/static/script/register_validation.js"></script>

    </body>
</html>