<?php 
include('partials/menu.php'); 
//include('../config/constants.php'); // Ensure that constants.php is included to define $conn
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>

        <br /><br />

        <?php 
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title : </td>
                    <td>
                        <input type="text" name="title" placeholder="Enter Title Here">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of the Food"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price : </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category :</td>
                    <td>
                        <select name="category">
                            <?php 
                                // Create SQL to get all active categories from database
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                                // Execute the Query
                                $res = mysqli_query($conn, $sql);
                                // Count rows to check whether we have categories or not
                                $count = mysqli_num_rows($res);

                                if ($count > 0) 
                                {
                                    // We have categories
                                    while ($row = mysqli_fetch_assoc($res)) 
                                    {
                                        $id = $row['id'];
                                        $title = $row['title'];
                                        ?>
                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                        <?php
                                    }
                                }
                                else 
                                {
                                    // We do not have categories
                                    ?>
                                    <option value="0">No Category Found</option>
                                    <?php
                                }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
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
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php 
            if(isset($_POST['submit'])) 
            {
                // Get the data from form
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];

                // Check whether the radio button for featured and active are checked or not
                $featured = isset($_POST['featured']) ? $_POST['featured'] : "No";
                $active = isset($_POST['active']) ? $_POST['active'] : "No";

                // Upload the image if selected
                if(isset($_FILES['image']['name'])) 
                {
                    // Get the details of the selected image
                    $image_name = $_FILES['image']['name'];

                    if($image_name != "") 
                    {
                        // Image is selected
                        // Rename the image
                        $ext = pathinfo($image_name, PATHINFO_EXTENSION);
                        // Create new name for image
                        $image_name = "Food-Name_" . rand(0000, 9999) . "." . $ext;

                        // Get the source path and destination path
                        $src = $_FILES['image']['tmp_name'];
                        $dest = "../images/food/" . $image_name;

                        // Finally upload the food image
                        $upload = move_uploaded_file($src, $dest);

                        if($upload == false) 
                        {
                            // Failed to upload the image
                            // Redirect to add food page with error message
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                            header('location:'.SITEURL.'Admin/add-food.php');
                            // Stop the process
                            die();
                        }
                    }
                }
                else 
                {
                    $image_name = ""; // Set default value as blank
                }

                // Insert into database
                $sql2 = "INSERT INTO tbl_food SET
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = $category,
                    featured = '$featured',
                    active = '$active'";

                // Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                if($res2 == true) 
                {
                    // Data inserted successfully
                    $_SESSION['add'] = "<div class='success'>Food Added Successfully.</div>";
                    header('location:'.SITEURL.'Admin/manage-food.php');
                }
                else 
                {
                    // Failed to insert data
                    $_SESSION['add'] = "<div class='error'>Failed to Add Food.</div>";
                    header('location:'.SITEURL.'Admin/manage-food.php');
                }
            }
        ?>
    </div>
</div>        

<?php include('partials/footer.php'); ?>
