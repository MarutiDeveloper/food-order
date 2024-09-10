<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Password</h1>

        <br><br>

        <?php
            // Display session message if set
            if (isset($_SESSION['change-pwd'])) {
                echo $_SESSION['change-pwd'];
                unset($_SESSION['change-pwd']);
            }

            // 1. Get the ID of Selected Admin
            $id = $_GET['id'];

            // 2. Create SQL Query to Get the Admin Details
            $sql = "SELECT * FROM tbl_admin WHERE id=$id";
            $res = mysqli_query($conn, $sql);

            if ($res == true) {
                // Check whether the data is available or not
                $count = mysqli_num_rows($res);
                if ($count == 1) {
                    // Get the Details
                    $row = mysqli_fetch_assoc($res);
                    $username = $row['username'];
                } else {
                    // Redirect to manage admin page
                    header('location:'.SITEURL.'Admin/manage-admin.php');
                }
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>" readonly>
                    </td>
                </tr>
                <tr>
                    <td>Current Password: </td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password">
                    </td>
                </tr>
                <tr>
                    <td>New Password: </td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>
                <tr>
                    <td>Confirm Password: </td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
            if (isset($_POST['submit'])) {
                // 1. Get the Data from Form
                $id = $_POST['id'];
                $current_password = md5($_POST['current_password']);
                $new_password = md5($_POST['new_password']);
                $confirm_password = md5($_POST['confirm_password']);

                // 2. Check whether the user with current ID and current password exists or not
                $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";
                $res = mysqli_query($conn, $sql);

                if ($res == true) {
                    $count = mysqli_num_rows($res);
                    if ($count == 1) {
                        // User exists and password can be changed
                        // Check whether the new password and confirm password match or not
                        if ($new_password == $confirm_password) {
                            // Update the password
                            $sql2 = "UPDATE tbl_admin SET password='$new_password' WHERE id=$id";
                            $res2 = mysqli_query($conn, $sql2);

                            if ($res2 == true) {
                                // Display success message
                                $_SESSION['change-pwd'] = "<div class='success'>Password Changed Successfully.</div>";
                                header('location:'.SITEURL.'Admin/update-password.php?id='.$id);
                            } else {
                                // Display error message
                                $_SESSION['change-pwd'] = "<div class='error'>Failed to Change Password.</div>";
                                header('location:'.SITEURL.'Admin/update-password.php?id='.$id);
                            }
                        } else {
                            // Passwords do not match
                            $_SESSION['change-pwd'] = "<div class='error'>Password did not match.</div>";
                            header('location:'.SITEURL.'Admin/update-password.php?id='.$id);
                        }
                    } else {
                        // User does not exist
                        $_SESSION['change-pwd'] = "<div class='error'>User Not Found.</div>";
                        header('location:'.SITEURL.'Admin/manage-admin.php');
                    }
                }
            }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>
