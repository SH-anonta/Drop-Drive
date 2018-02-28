<div id="Header">
    <a href="/filehost/">Home</a>
    
    <?php
        require_once($_SERVER['DOCUMENT_ROOT'] . '/filehost/utility/session_facade.php');
        
        if(\utility\session\Session::userIsLoggedIn()){
            echo '<a href="/filehost/logout"> Logout</a>';
        }
        else{
            echo '<a href="/filehost/register"> Register </a>';
            echo '<a href="/filehost/login"> Login </a>';
        }
    ?>

    <hr/>
</div>