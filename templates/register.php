<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Register</title>
    </head>
    
    <body>
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
        <form action="/filehost/register" method="POST">
            <input required type="text" placeholder="User name" name="user_name" value="<?php echo $uname?>">
            <br>
            <input required type="email" placeholder="Email" name="email" name="user_name" value="<?php echo $email?>">
            <br>
            <input required type="password" placeholder="Password" name="password" name="user_name" value="<?php echo $pw?>">
            <br>
            <input required type="password" placeholder="Confirm Password" name="confirm_password" name="user_name" value="<?php echo $confirm_pw?>">
            <br>
            <button type="submit">Register</button>
        </form>
    </body>
</html>