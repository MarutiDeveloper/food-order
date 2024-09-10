<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
    <h1>Manage Admin</h1>
    <br /><br />
    <?php
            if(isset($_SESSION['add'])) {
                echo $_SESSION['add']; // Display Session Message... 
                unset($_SESSION['add']); // Removing Session...
            }
            
            // <br /> <br />

             if(isset($_SESSION['delete']))
        {
            echo $_SESSION['delete']; // Display session message
            unset($_SESSION['delete']); // Remove session message
        }

        if(isset($_SESSION['update']))
        {
            echo $_SESSION['update']; // Display session message
            unset($_SESSION['update']); // Remove session message
        }

        if(isset($_SESSION['user-not-found']))
        {
            echo $_SESSION['user-not-found']; // Display session message
            unset($_SESSION['user-not-found']); // Remove session message
        }

        if(isset($_SESSION['pwd-not-match']))
        {
            echo $_SESSION['pwd-not-match']; // Display session message
            unset($_SESSION['pwd-not-match']); // Remove session message
        }

        if(isset($_SESSION['change-pwd']))
        {
            echo $_SESSION['change-pwd']; // Display session message
            unset($_SESSION['change-pwd']); // Remove session message
        }
        ?>
        <br><br><br>

     <!-- button to Add Category -->

     <a href="add-admin.php" class="btn-primary">Add Admin</a>
                <br /><br /><br />

                <table class="tbl-full">
            <tr>
                <th>S.No.</th>
                <th>Full Name</th>
                <th>User Name</th>
                <th>Action</th>
            </tr>

            <?php 
            // Query to Get All Admin
            $sql = "SELECT * FROM tbl_admin";
            // Execute the query
            $res = mysqli_query($conn, $sql);

            // Check whether the query is executed or not
            if($res==TRUE)
            {
                // Count Rows to Check whether we have data in database or not
                $count = mysqli_num_rows($res); // Function to get all the rows in database

                $sn=1; // Create a variable and assign the value

                // Check the number of rows
                if($count>0)
                {
                    // We have data in database
                    while($rows=mysqli_fetch_assoc($res))
                    {
                        // Using while loop to get all the data from database.
                        // And while loop will run as long as we have data in database

                        // Get individual data
                        $id=$rows['id'];
                        $full_name=$rows['full_name'];
                        $username=$rows['username'];

                        // Display the values in our table
                        ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $full_name; ?></td>
                            <td><?php echo $username; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>Admin/update-password.php?id=<?php echo $id; ?>"class="btn-primary">Change Password</a>
                                <a href="<?php echo SITEURL; ?>Admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a> 
                                <a href="<?php echo SITEURL; ?>Admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a> 
                            </td>
                        </tr>

                        <?php
                    }
                }
                else
                {
                    // We Do not have data in database
                }
            }
            ?>

        </table>

    </div>
</div>

<?php include('partials/footer.php'); ?>