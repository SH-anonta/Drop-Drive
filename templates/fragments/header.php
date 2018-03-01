<div id="Header">
    <a href="/filehost/">Home</a>
    |

    <?php
        require_once($_SERVER['DOCUMENT_ROOT'] . '/filehost/utility/session_facade.php');
        
        if(\utility\session\Session::userIsLoggedIn()){
            $user = \utility\session\Session::getUser();
            echo 'Hello ';
            printf('<a href="/filehost/user/%d">%s</a>', $user->id, $user->user_name);
            echo '|';
            echo '<a href="/filehost/logout"> Logout</a>';
        }
        else{
            echo '<a href="/filehost/register"> Register </a>';
            echo '|';
            echo '<a href="/filehost/login"> Login </a>';
        }
    ?>

    <hr/>
</div>