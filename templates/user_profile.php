<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home page</title>
    <link rel="stylesheet" href="/filehost/static/style/global.css">
</head>
    <body>
        <?php
            // show header
            require('fragments/header.php');
        ?>
        
        <h3>User profile</h3>

        <table>
            <tr>
                <td><b>ID</b></td>
                <td> <?php echo $_user->id ?> </td>
            </tr>

            <tr>
                <td><b>Name</b></td>
                <td> <?php echo $_user->user_name ?> </td>
            </tr>

            <tr>
                <td><b>Email</b></td>
                <td> <?php echo $_user->email ?> </td>
            </tr>


        </table>

    </body>
</html>