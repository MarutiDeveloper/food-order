<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Update category</h1>
            <br /><br />

            <?php 
                // Check whether the ID is set or not
                if(isset($_GET['id']))
                {
                    // Get the ID and all other details
                    $id = $_GET['id'];

                    // Create SQL Query to get all other details
                    $sql = "SELECT * FROM tbl_category WHERE id=$id";

                    // Execute the Query
                    $res = mysqli_query($conn, $sql);

                    // Count the rows to check whether the ID is valid or not
                    $count = mysqli_num_rows($res);

                    if($count == 1)
                    {
                        // Get all the data
                        $row = mysqli_fetch_assoc($res);
                        $title = $row['title'];
                        $current_image = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];
                    }
                    else
                    {
                        // Redirect to manage category with session message
                        $_SESSION['no-category-found'] = "<div class='error'>Category Not Found.</div>";
                        header('location:'.SITEURL.'Admin/manage-category.php');
                    }
                }
                else
                {
                    // Redirect to Manage Category Page
                    header('location:'.SITEURL.'Admin/manage-category.php');
                }
            ?>



            <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                            <td>
                                <input type="text" name="title" value="<?php echo $title; ?>">
                            </td>
                    </tr>

                <tr>
                    <td>Current Image: </td>
                            <td>
                                <?php
                                    if($current_image != "")
                                    {
                                        //Display the Image
                                        ?>
                                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="125px">
                                        <?php

                                    }
                                    else
                                    {
                                        //Display the message.
                                        echo "<div class='error'>Image Not Added.</div>";
                                    }
                                ?>
                            </td>
                    </tr>

                <tr>
                    <td>New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                        
                </tr>

                        <tr>
                            <td>Feature:</td>
                            <td>
                                <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes

                                <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No"> No
                            </td>
                        </tr>

                        <tr>
                            <td>Active:</td>
                            <td>
                                <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes

                                <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No"> No
                            </td>
                        </tr>

                        <tr>
                        <td colspan="2">
                                <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <input type="submit" name="submit" value="Update category"class="btn-secondary">
                            </td>
                        </tr>
                
                

                </table>  
            </form> 

                <?php 
                    if(isset($_POST['submit']))
                    {
                        // Get all the values from our form
                        $id = $_POST['id'];
                        $title = $_POST['title'];
                        $current_image = $_POST['current_image'];
                        $featured = $_POST['featured'];
                        $active = $_POST['active'];

                        // Updating if New Image is selected.
                        //Check whether the Image is selected or not.
                        if (isset($_FILES['image']['name'])) 
                        {
                            //Get the Image Details.
                            $image_name = $_FILES['image']['name'];

                            //Check whether the images is Avalable or not.
                            if ($image_name != "") 
                            {
                               //Image Avalable.
                               //Upload the New Image

                                //Auto Rename Our Image
                            //Get the extension of our image (jpg, gif, png, etc) e.g. "food1.jpg"
                            $ext = pathinfo($image_name, PATHINFO_EXTENSION);

                            //Rename the image
                            $image_name = "Food_Category_".rand(000, 999).'.'.$ext;

                            $source_path = $_FILES['image']['tmp_name'];
            
                            $destination_path = "../images/category/".$image_name;

                            //Finally upload the Image.
                            $upload = move_uploaded_file($source_path, $destination_path);

                            //Check whether the image is uploaded or not.
                            //And if image is not uploaded than we will stop the process and redirect with error message.
                            if($upload==false)
                            {
                                //set message
                                $_SESSION['upload'] = "<div class='error'>Faild To Upload Image.</div>";
                                //Redirect to add Category Page.
                                header('location:'.SITEURL.'Admin/add-category.php');
                                //Stop the Process.
                                die();
                            }
                                   
                                //Remove the Current Image if Avalable
                                if ($current_image != "") 
                                {
                                    $remove_path = "../images/category/".$current_image;

                                    $remove = unlink($remove_path);

                                        //Check whether the image is remove or not.
                                        //if faild to remove than Display Message and stop the process.
                                    if ($remove == false) 
                                    {
                                        //Faild to remove image..
                                        $_SESSION['failed-remove'] = "<div class='error'>Failed to remove Current Image.</div>";
                                        header('location:'.SITEURL.'Admin/manage-category.php');
                                        die();
                                    }
                                }
                                
                            }
                            else
                            {
                                $image_name = $current_image;
                            }
                        }
                        else
                        {
                            $image_name = $current_image;
                        }

                        //update the database.
                        $sql2 = "UPDATE tbl_category SET 
                        title = '$title',
                        image_name = '$image_name',
                        featured = '$featured',
                        active = '$active'
                        WHERE id=$id
                        
                        ";

                        //Execute the Query.
                        $res2 = mysqli_query($conn, $sql2);

                        //Redirect to manage category with message.
                        //check whether executed or not.
                        if ($res2 == true) 
                        {
                            //category Updated..
                            $_SESSION['update'] = "<div class='success'>Category is Updated Successfully</div>";
                            header('location:'.SITEURL.'Admin/manage-category.php');
                        }
                        else 
                        {
                            //faild to update category.
                            $_SESSION['update'] = "<div class='error'>Faild to update Category</div>";
                            header('location:'.SITEURL.'Admin/manage-category.php');
                        }

                    }    
                 ?>   

        </div>
    </div>
<?php include('partials/footer.php'); ?>