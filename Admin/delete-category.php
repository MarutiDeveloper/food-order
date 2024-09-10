<?php 
include('../config/constants.php'); 

    //Check Whether the Id And Image_name value is set or not.
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //Get the value and delete
        //echo "Get Value And Delete";
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //Remove the physical file is Avalable.
        if($image_name !== "")
        {
            //Image Is Avalable. Soremove it.
            $path = "../images/category/".$image_name;
            //Remove the image.
            $remove = unlink($path);

            //If failed to remove image than add an error message and stop the process.
            if($remove==false)
            {
                //Set the session message.
                $_SESSION['remove'] = "<div class='error'>Faild to Remove Category Image.</div>";
                //Redirect to manage category page.
                header('location:'.SITEURL.'Admin/manage-category.php');
                //Stop the process.
                die();
            }
        }

        //Delete Data from Database.
        //SQL Query Delete Data From Database.
        $sql = "DELETE FROM tbl_category WHERE id=$id";
        
        //Execute the Query.
        $res = mysqli_query($conn, $sql);

        //Check whether the data deleted from database or not.
        if($res==true)
        {
            //Set Success Message And Redirect.
            $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully.</div>";
            //Redirect to manage category page.
            header('location:'.SITEURL.'Admin/manage-category.php');
        }
        else
        {
            //Set Faild Message And Redirect.
            $_SESSION['delete'] = "<div class='error'>Faild to Delete Category.</div>";
            //Redirect to manage category page.
            header('location:'.SITEURL.'Admin/manage-category.php');
        }

    }
    else
    {
        //Redirect to manage category page.
        header('location:'.SITEURL.'Admin/manage-category.php');
    }

?>

