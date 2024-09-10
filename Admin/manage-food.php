<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
    <h1>Manage Food</h1>
    <br /><br />
     <!-- button to Add Food -->

     <a href="<?php echo SITEURL; ?>Admin/add-food.php" class="btn-primary">Add Food</a>
                <br /><br /><br />

                    <?php 

                        if(isset($_SESSION['add']))
                        {
                            echo $_SESSION['add'];
                            unset($_SESSION['add']);
                        }

                        if(isset($_SESSION['delete']))
                        {
                            echo $_SESSION['delete'];
                            unset($_SESSION['delete']);
                        }

                        if(isset($_SESSION['upload']))
                        {
                            echo $_SESSION['upload'];
                            unset($_SESSION['upload']);
                        }

                        if(isset($_SESSION['unauthorized']))
                        {
                            echo $_SESSION['unauthorized'];
                            unset($_SESSION['unauthorized']);
                        }

                        if(isset($_SESSION['update']))
                        {
                            echo $_SESSION['update'];
                            unset($_SESSION['update']);
                        }
                    
                    ?>

            <table class="tbl-full">
                <tr>
                    <th>S.No.</th>
                    <th>Title: </th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Action</th>
                </tr>


                <?php 
                
                        //Create a SQL Query to Get All the Food.
                        $sql = "SELECT * FROM tbl_food";

                        //Execute the Query.
                        $res = mysqli_query($conn, $sql);

                        //Count Rows to check whether we have foods or not.
                        $count = mysqli_num_rows($res);

                        //Create Serial Number Variable And Set Default Value As 1.
                        $sn=1;

                        if ($count>0) 
                        {
                            // We have food in database 
                            // Get the food from database and display.
                            while ($row=mysqli_fetch_assoc($res)) 
                            {
                                //Get the Value from Individual Colums.
                                $id = $row['id'];
                                $title = $row['title'];
                                $price = $row['price'];
                                $image_name = $row['image_name'];
                                $featured = $row['featured'];
                                $active = $row['active'];
                                ?>

                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $title; ?></td>
                                        <td>₹ <?php echo $price; ?></td>
                                        <td>
                                            <?php 

                                                //Check whether we have Image or not.
                                                if ($image_name== "") 
                                                {
                                                    //We Donot have Image. Display Error Message.
                                                    echo "<div class='error'>Image Not Added</div>";
                                                }
                                                else 
                                                {
                                                    //We have Image And Display The Image.
                                                    ?>

                                                        <img src="<?php echo SITEURL; ?>images/Food/<?php echo $image_name; ?>" width="125px">


                                                    <?php
                                                }

                                            ?>
                                        </td>
                                        <td>
                                            <?php echo $featured; ?>
                                        </td>
                                        <td>
                                            <?php echo $active; ?>
                                        </td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>Admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Food</a>
                                            <a href="<?php echo SITEURL; ?>Admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Food</a>
                                        </td>
                                    </tr>

                                <?php
                            }
                        }
                        else
                        {
                            //Food Not Added in Database. 
                            echo "<tr> <td colspan ='7' class='error'> Food not Added Yet. </td></tr>";
                        }
                ?>        


               
                
            
            </table>
    </div>

    
</div>

<?php include('partials/footer.php'); ?>