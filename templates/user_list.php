<!DOCTYPE html>
<html lang="en">
    <?php
        //expects $_user_list to have an array of users 
    ?>
    <head>
        <title>All Users</title>
    </head>
    
    <body>
        <h3>All users</h3>
        
        <table>
            <tr>
                <td><b>UserName</b></td>
                <td><b>Email</b></td>
            </tr>

            <?php
                foreach($_user_list as $row){
                    echo '<tr>';
                    printf('<td>%s</td>', $row[0]);
                    printf('<td>%s</td>', $row[1]);
                    echo '</tr>';
                }
            ?>
        </table>

    </body>
</html>