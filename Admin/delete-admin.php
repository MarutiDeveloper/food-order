<?php 
// Include constants.php file
include('../config/constants.php'); 

// 1. Get the ID of Admin to be deleted
$id = $_GET['id'];

// Check if the ID is set and is a valid integer
if (isset($id) && is_numeric($id)) {
    // 2. Create SQL Query to Delete Admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    // Execute the Query
    $res = mysqli_query($conn, $sql);

    // 3. Check whether the Query Executed Successfully or not
    if ($res == true) {
        // Query Executed Successfully and Admin Deleted
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully</div>";
        // Redirect to Manage Admin Page with Success Message
        header('location:'.SITEURL.'Admin/manage-admin.php');
    } else {
        // Failed to Delete Admin
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Admin</div>";
        // Redirect to Manage Admin Page with Error Message
        header('location:'.SITEURL.'Admin/manage-admin.php');
    }
} else {
    // Redirect to Manage Admin Page if ID is not valid
    $_SESSION['delete'] = "Invalid Admin ID";
    header('location:'.SITEURL.'Admin/manage-admin.php');
}
?>
