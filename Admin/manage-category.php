<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
    <h1>Manage category</h1>
    <br /><br />

    <?php 
               if(isset($_SESSION['add']))
               {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
               } 

               if(isset($_SESSION['remove']))
               {
                    echo $_SESSION['remove'];
                    unset($_SESSION['remove']);
               } 

               if(isset($_SESSION['delete']))
               {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
               } 

               if(isset($_SESSION['no-category-found']))
               {
                    echo $_SESSION['no-category-found'];
                    unset($_SESSION['no-category-found']);
               }

               
               if(isset($_SESSION['update']))
               {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
               } 

               if(isset($_SESSION['upload']))
               {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
               } 

               if(isset($_SESSION['failed-remove']))
               {
                    echo $_SESSION['failed-remove'];
                    unset($_SESSION['failed-remove']);
               } 
        
        ?>

        <br><br>
     <!-- button to Add Category -->

     <a href="<?php echo SITEURL; ?>Admin/add-category.php" class="btn-primary">Add Category</a>
                <br /><br /><br />

                <table class="tbl-full">
            <tr>
                <th>S.No.</th>
                <th>Title:</th>
                <th>Image</th>
                <th>Features</th>
                <th>Active</th>
                <th>Action</th>
            </tr>

            <?php
                    //Query to Get all data from Database.
                    $sql = "SELECT * FROM tbl_category";

                    //Execute Query
                    $res = mysqli_query($conn, $sql);

                    //Count rows.
                    $count = mysqli_num_rows($res);

                    //Create a Serial Number Variable and Assign Value as 1.
                    $sn=1;

                    //Check whether we have data in database or not.
                    if($count>0)
                    {
                        // we have data in database.
                        //get the data and display
                        while($rows=mysqli_fetch_assoc($res))
                        {
                            $id = $rows['id'];
                            $title = $rows['title'];
                            $image_name = $rows['image_name'];
                            $featured = $rows['featured'];
                            $active = $rows['active'];	
                            ?>

                                <tr>
                                    <td><?php echo $sn++; ?>.</td>
                                    <td><?php echo $title; ?></td>

                                    <td>
                                        <?php 
                                            //Check whether Image is Avalable or Not.
                                            if($image_name!="")
                                            {
	                                            //Display the image
                                                ?>
		                                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px">

	                                            <?php
                                            }
                                            else
                                            {
	                                            //Display the message
                                                echo "<div class='error'>Image not Added.</div>";
                                            } 
                                        ?>
                                    </td>

                                    <td><?php echo $featured; ?></td>
                                    <td><?php echo $active; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>Admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update Category</a>
                                        <a href="<?php echo SITEURL; ?>Admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Category</a>
                                    </td>
                                </tr>

                            <?php

                        }
                    }
                    else
                         // we do not have data in database.
                        //we'll display the message inside table.
                        ?>
	                        <!-- <tr>
		                        <td colspan="6"><div class="error">No Category Added.</div></td>
	                        </tr> -->
                        <?php
                    ?>
                     
                        
                    

               
            

               
           
            
           
        </table>
    </div>

    
</div>

<?php include('partials/footer.php'); ?>