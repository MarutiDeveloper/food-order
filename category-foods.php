<?php include('partials-front/menu.php') ?>


<?php 
    
    //Check Whether id is passed or not.
    if(isset($_GET['category_id']))
    {
        //Category Id is Set and get the id
        $category_id = $_GET['category_id'];
        //Get the Category Title Based on Category ID
        $sql = "SELECT title FROM tbl_category WHERE id=$category_id";

        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //Get The Value From Data base.
        $row = mysqli_fetch_assoc($res);
        //Get The Title.
        $category_title = $row['title'];


    }
    else
    {
        //Category Not Passed
        //Redirect to home Page.
        header('location:'.SITEURL);
    }

?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
            
                //Create SQL Query to Get foods based on selected category.
                $sql2 = "SELECT * FROM tbl_food WHERE category_id=$category_id";

                //Execute the Query.
                $res2 = mysqli_query($conn, $sql2);

                //Count the rows.
                $count2 = mysqli_num_rows($res2);

                //Check whether the Food is Avalable Or not.
                if($count2>0)
                {
                    //Food is Available.
                    while($row2=mysqli_fetch_assoc($res2))
                    {
                        $id =$row2['id'];
                        $title = $row2['title'];
                        $price = $row2['price'];
                        $description = $row2['description'];
                        $image_name = $row2['image_name'];
                        ?>

                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <?php 
                                    
                                        if($image_name=="")
                                        {
                                            //Image Not Available.
                                            echo "<div class='error'><b>Image Not Available.</b></div>";
                                        }
                                        else
                                        {
                                            //Image Is Available.
                                            ?>
                                                <img src="<?php echo SITEURL; ?>images/Food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">

                                            <?php
                                        }
                                    
                                    ?>
                                    
                                </div>

                                <div class="food-menu-desc">
                                    <h4><?php echo $title; ?></h4>
                                    <p class="food-price">₹<?php echo $price; ?></p>
                                    <p class="food-detail">
                                         <?php echo $description; ?>
                                    </p>
                                    <br>

                                    <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                                </div>
                             </div>

                        <?php
                    }
                }
                else
                {
                    //Food is not Available.
                    echo "<div class='error'><b>Food is not Available.</b></div>";

                }
            
            
            ?>


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php') ?>  