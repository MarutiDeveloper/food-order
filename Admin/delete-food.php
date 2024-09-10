<?php 
    
    //Include Constants.php
    include('../config/constants.php');

    //echo " Delete Food Page"; 

    if(isset($_GET['id']) && isset($_GET['image_name']))
    {
        //Process to Delete.
        //echo "Process to Delete";

        //1. Get ID And Image Name.
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //2. Remove the Image if Available
        // Check whether the image is avalable or not and Delete only if available
        if($image_name != "")
        {
            // IT has image and need to remove from folder
            //Get the Image Path
            $path = "../images/Food/".$image_name;

            //Remove Image file from folder.
            $remove = unlink($path);

            //Check whether the image is removed or not.
            if($remove==false)
            {
                //Failed to Remove Image.
                $_SESSION['upload'] = "<div class='error'><br>Failed to remove image file.</br></div>";
                //Redirect to manage food page.
                header('location:'.SITEURL.'Admin/manage-food.php');
                //Stop the process of Deleting food.
                die();

            }
        }

        //3. Delete Food from Database.
        $sql = "DELETE FROM tbl_food WHERE id=$id";
        //Execute the Query 
        $res = mysqli_query($conn, $sql);

        //Check whether the Query is executed or not and set session message respectively.
        //4. Redirect to Manage Food with Session Message.
        if($res==true)
        {
            //Food Deleted
            $_SESSION['delete'] = "<div class='success'><br>Food Deleted Successfully...</br></div>";
            header('location:'.SITEURL.'Admin/manage-food.php');
        }
        else
        {
            //Failed to delete food.
            $_SESSION['delete'] = "<div class='error'><br>Food Not Deleted </br></div>";
            header('location:'.SITEURL.'Admin/manage-food.php');
        }

        


    }
    else
    {
        //Redirect to manage food page.
        //echo "Process to Redirect";
        $_SESSION['unauthorized'] = "<div class='error'>Unauthorized Access.</div>";
        header('location'.SITEURL.'Admin/manage-food.php');
    }


?>
     
