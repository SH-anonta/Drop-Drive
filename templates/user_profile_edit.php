<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit user</title>
</head>
    <body>
        <p>User profile</p>

        <table>
            <tr>
                <td><b>ID</b></td>
                <td> <?php echo $_user['ID'] ?> </td>
            </tr>

            <tr>
                <td><b>Name</b></td>
                <td> <?php echo $_user['UserName'] ?> </td>
            </tr>

            <tr>
                <td><b>Email</b></td>
                <td> <?php echo $_user['Email'] ?> </td>
            </tr>


        </table>

    </body>
</html>