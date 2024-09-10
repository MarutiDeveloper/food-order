<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <br><br>

        <?php 
            //1. Get the ID of Selected Admin.
            $id = $_GET['id'];
            
            //2. Create SQL Query to Get the Detail.
            $sql = "SELECT * FROM tbl_admin WHERE id=$id";

            //Execute the Query.
            $res = mysqli_query($conn, $sql);

            //3. Check whether the Query Executed Successfully or not
            if ($res == true) {
                // Check whether the Data Available or not
                $count = mysqli_num_rows($res);
                // Check whether we have admin data or not.
                if ($count == 1) {
                    // Get the Details.
                    //echo "Admin Available";
                    $rows = mysqli_fetch_assoc($res);

                    $full_name = $rows['full_name'];
                    $username = $rows['username'];
                } else {
                    //Redirect to manage Admin
                    header('location:'.SITEURL.'Admin/manage-admin.php');
                }
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="full_name" value="<?php echo $full_name; ?>"></td>
                </tr>
                <tr>
                    <td>User Name: </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php 
    // Check whether the submit button is clicked or not.
    if (isset($_POST['submit'])) {
        //echo "Button Clicked";
        // Get all the values from form to Update.
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];

        // Create a SQL Query to Update Admin.
        $sql = "UPDATE tbl_admin SET
            full_name = '$full_name',
            username = '$username'
            WHERE id=$id";

        //Execute the Query 
        $res = mysqli_query($conn, $sql);

        // Check Whether the Query executed or not.
        if ($res == true) {
            //Query executed and Admin Updated.
            $_SESSION['update'] = "<div class='success'>Admin Updated Successfully</div>";
            //Redirect to manage admin page
            header('location:'.SITEURL.'Admin/manage-admin.php');
        } else {
            // Failed to Update Admin.
            $_SESSION['update'] = "<div class='error'>Failed to Update Admin</div>";
            //Redirect to manage admin page
            header('location:'.SITEURL.'Admin/manage-admin.php');
        }
    }
?>

<?php include('partials/footer.php'); ?>
