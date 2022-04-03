<?php
    //Authorization or access control
    if(!isset($_SESSION['user']))//If user session is not set
    {
        //Redirect to login page with message
        $_SESSION['no-login']="<div class='failure text-center google-font'>Please Log In To Access Admin Panel</div>";
        header('location:'.SITE_URL.'admin/login.php');
    }

?>