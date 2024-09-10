<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>

        <br><br>

        <?php 
               if(isset($_SESSION['add']))
               {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
               } 

               if(isset($_SESSION['upload']))
               {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
               } 
        
        ?>

        <br><br>

        <!-- Add Category Form Start -->
        <form action="" method="POST" enctype="multipart/form-data">

                <table class="tbl-30">
                    <tr>
                        <td>Title:</td>
                        <td>
                            <input type="text" name="title" placeholder="Category Title">
                        </td>
                    </tr>
                    <tr>
                        <td>Select Image:</td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>
                    <tr>
                        
                        <td>Feature:</td>
                        <td>
                            <input type="radio" name="featured" value="Yes"> Yes
                            <input type="radio" name="featured" value="No"> No
                        </td>
                    </tr>
                    <tr>
                        <td>Active:</td>
                        <td>
                            <input type="radio" name="active" value="Yes"> Yes
                            <input type="radio" name="active" value="No"> No
                        </td>
                        <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Category"class="btn-secondary">
                        </td>
                        </tr>
                    </tr>
                </table>
        </form>
        <!-- Add Category Form End -->

        <?php 

            //Check whether the submit Button is Clicked or Not.
            if(isset($_POST['submit']))
            {
                    //Clicked
                   // echo "Button is Clicked";

                   //1. Get the Value from Category form.
                   $title = $_POST['title'];

                   //For Radio input, we need to check whether the button is selected or not.
                   if(isset($_POST['featured']))
                   {
                        //Get the value from form.
                        $featured = $_POST['featured'];
                   }
                   else
                   {
                        //Set the Default Value.
                        $featured = "No";
                   }
                   if(isset($_POST['active']))
                   {
                        //Get the value from form.
                        $active = $_POST['active'];
                   }
                   else
                   {
                        //Set the Default Value.
                        $active = "No";
                   }

                   //Check whether the image is selected or not and set the value for image name accoridingly.
	                // print_r($_FILES['image']);
	
	                // die(); //Break the code Here.

                    if(isset($_FILES['image']['name']))
	                {
		                //Upload the image
                        //To upload image we need image name, source path and destination path.
		                $image_name = $_FILES['image']['name'];

                        // Upload the image only if image is selected.
                        if($image_name != "")
                        {

                     

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
                                header('location:'.SITEURL.'Admin/manage-category.php');
                                //Stop the Process.
                                die();
                            }
                        }    
	                }
	                else
	                {
	        	        //Don't Upload Image and set the image_name value as blank
		                $image_name="";
	                }

                   //2. Create SQL Query to Insert Category into Database.
                   $sql = "INSERT INTO tbl_category SET
                        title='$title',
                        image_name='$image_name',
                        featured='$featured',
                        active='$active'
                   ";

                   //3. Execute the Query And Save in Database
                   $res = mysqli_query($conn, $sql);


                   //4. Check whether the Query is Executed or not and data added or not.
                   if($res==true)
                   {
                        //Query Executed and Category Added.
                        $_SESSION['add'] = "<div class='success'> Category Added Successfully.</div>";
                        header('location:'.SITEURL.'Admin/manage-category.php');
                   }
                   else
                   {
                        //Faild to Add Category.
                        $_SESSION['add'] = "<div class='error'> Faild to Add Category.</div>";
                        header('location:'.SITEURL.'Admin/add-category.php');
                   }
            }
        
        
        
        
        
        ?>

    </div>  
 </div>     

<?php include('partials/footer.php'); ?>