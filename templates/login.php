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

<script>

(function(){
    function validateLoginData(event){
        var all_data_valid = true;

        var uname = document.querySelector('input[name=user_name]').value;
        var pass = document.querySelector('input[name=password]').value;

        var error_list = document.querySelector('#ErrorList');

        if(uname == ''){
            all_data_valid = false;
            alert('Username is required');
            console.log('Username is required');
        }
        if(pass == ''){
            all_data_valid = false;
            alert('Password is required');
            console.log('Password is required');
        }
        

        if(!all_data_valid){
            event.preventDefault();
        }
        
    }

    var login_btn = document.querySelector('#LoginForm button');
    login_btn.addEventListener('click',validateLoginData);

})();

</script>

</html>