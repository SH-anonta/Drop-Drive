<div id="Header">
    <a href="/filehost/">Home</a>
    |

    <?php
        require_once($_SERVER['DOCUMENT_ROOT'] . '/filehost/utility/session_facade.php');
        
        if(\utility\session\Session::userIsLoggedIn()){
            echo '<a href="/filehost/logout"> Logout</a>';
            echo '|';
            echo 'Welcome ' . \utility\session\Session::getUser()->user_name;
        }
        else{
            echo '<a href="/filehost/register"> Register </a>';
            echo '|';
            echo '<a href="/filehost/login"> Login </a>';
        }
    ?>

    <hr/>
</div>