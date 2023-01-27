<?php
    //Authorization access control
    //check whether the user is logged in
    if(!isset($_SESSION['user']))//if user is not set
    {
        //user is not logged in
        //Redirect to login page with a message
        $_SESSION['not-logged-message'] = "<div class='error center'>Please login to access admin panel</div>";
        //redirect to login page
        header('location:'.SITEURL.'admin/login.php');
    }
?>