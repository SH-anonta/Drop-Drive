<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home page</title>
</head>
    <body>
        <p>User profile</p>

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