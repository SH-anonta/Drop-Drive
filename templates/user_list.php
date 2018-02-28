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
                foreach($_user_list as $user){
                    echo '<tr>';
                        echo '<td>';
                            printf('<a href="/filehost/user/%s">%s</a>', $user->id, $user->user_name);
                        echo '</td>';
                        
                        printf('<td>%s</td>', $user->email);
                    echo '</tr>';
                }
            ?>
        </table>

    </body>
</html>