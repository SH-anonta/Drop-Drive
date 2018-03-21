<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Register</title>
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


        <script>

(function(){
    function addErrorMsg(msg){
        var error_msg = document.querySelector('#error_msg');
        var li = document.createElement("li");
        li.appendChild(document.createTextNode(msg));
        error_msg.appendChild(li);
    }

    function clearErrorMsgs(){
        var error_msg = document.querySelector('#error_msg');
        error_msg.innerHTML = '';
    }

    function validateRegisterData(event){
        clearErrorMsgs();
        var all_data_valid = true;

        var uname = document.querySelector('input[name=user_name]').value;
        var email = document.querySelector('input[name=email]').value;
        var pass = document.querySelector('input[name=password]').value;
        var confirm_pass = document.querySelector('input[name=confirm_password]').value;

        if(uname == ''){
            all_data_valid = false;
            addErrorMsg('Username is required ');
        }
        if(email == ''){
            all_data_valid = false;
            addErrorMsg('Email is required');
        }
        if(pass == ''){
            all_data_valid = false;
            addErrorMsg('Password is required ');
        }
        if(confirm_pass == ''){
            all_data_valid = false;
            addErrorMsg('Confirm Password is required ');
        }
        if(pass != confirm_pass){
            all_data_valid = false;
            addErrorMsg('Passwords do not match');
        }

        if(!all_data_valid){
            event.preventDefault();
        }
        
    }

    var register_btn = document.querySelector('#RegisterForm button');
    register_btn.addEventListener('click',validateRegisterData);

})();

</script>

    </body>
</html>