<?php 
    // Authorization - Access Control.
    // Check whether the user is logged in or not. 
    if(!isset($_SESSION['user'])) //if user session is not set
    {
        //user is not logged in.
        // Redirect to login page with message.
        $_SESSION['no-login-message'] = "<div class='error'>Please Login to Access Admin Panel.</div>";
        // Redirect to login Page.
        header('location:'.SITEURL.'Admin/login.php');
    }
?>