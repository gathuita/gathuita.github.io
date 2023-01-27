<?php
    include('../config/constants.php');
    //1. Destroy session
    session_destroy();//unsets $session['user']
    //2. Redirect to login page
//$_SESSION['log-out'] = "<div class='success'>Logged-out successfull</div>";
    header('location:'.SITEURL.'admin/login.php');
?>