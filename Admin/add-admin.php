<?php
include('partials/menu.php'); 
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <br><br>

        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            } 
        ?>
       

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="full_name" placeholder="Enter Your Name"></td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="username" placeholder="Enter Username"></td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="password" placeholder="Enter Your Password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php 
// Process the Value from form and save it in database 
if(isset($_POST['submit'])) {
    // Get the Data from form
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Password Encryption with MD5

    // SQL Query to save the data in Database 
    $sql = "INSERT INTO tbl_admin SET
        full_name='$full_name',
        username='$username',
        password='$password'";

    // Execute Query and Save in Database
    $res = mysqli_query($conn, $sql);

    // Check whether the query executed successfully or not
    if($res == true) {
        // Data inserted
        $_SESSION['add'] = "<div class='success'>Admin added successfully.</div>";
        // Redirect to Manage Admin Page
        header("location:".SITEURL.'Admin/manage-admin.php'); 
    } else {
        // Data not inserted
        $_SESSION['add'] = "<div class='error'>Failed to add admin.</div>";
        // Redirect to Add Admin Page
        header("location:".SITEURL.'Admin/add-admin.php'); 
    }
}
?>
