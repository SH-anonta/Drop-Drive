<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Register</title>
    </head>
    
    <body>
        <h3>Register</h3>

        <form action="/filehost/register" method="POST">
            <input required type="text" placeholder="User name" name="user_name">
            <br>
            <input required type="email" placeholder="Email" name="email">
            <br>
            <input required type="password" placeholder="Password" name="password">
            <br>
            <input required type="password" placeholder="Confirm Password" name="confirm_password">
            <br>
            <button type="submit">Register</button>
        </form>
    </body>
</html>