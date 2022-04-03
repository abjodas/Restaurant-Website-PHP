<?php
    include('../config/constants.php');
    //Destroy the session and redirect to the login page
    session_destroy();//Unsets SESSION['user']
    header('location:'.SITE_URL.'admin/login.php');
?>