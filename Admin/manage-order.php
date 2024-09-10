<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
    <h1>Manage Order</h1>
     <!-- Manage Order -->

     
                <br /><br /><br />

                <?php  
                
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                
                ?>
                <br><br>

                <table class="tbl-full">
            <tr>
                <th>S.No.</th>
                <th>Food</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Customer Name</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Address</th>
                <th>Action</th>
            </tr>

                <?php 
                
                    //Get All the Order From Database.
                    $sql = "SELECT * FROM tbl_order ORDER BY id DESC";
                    //Execute the Query.
                    $res = mysqli_query($conn, $sql);
                    //Count the rows.
                    $count = mysqli_num_rows($res);

                    $sn=1; //Create a Serial Number and Set its initial values As 1.

                    if($count>0)
                    {
                        //Order Available.
                        while($row=mysqli_fetch_assoc($res))
                        {
                            //Get Allthe Order Details.
                            $id = $row['id'];
                            $food = $row['food'];
                            $price = $row['price'];
                            $qty = $row['qty'];
                            $total = $row['total'];
                            $order_date = $row['order_date'];
                            $status = $row['status'];
                            $customer_name = $row['customer_name'];
                            $customer_contact = $row['customer_contact'];
                            $customer_email = $row['customer_email'];
                            $customer_address = $row['customer_address'];

                            ?>

                                <tr>
                                        <td><?php echo $sn++; ?>.</td>
                                        <td><?php echo $food; ?></td>
                                        <td><?php echo $price; ?></td>
                                        <td><?php echo $qty; ?></td>
                                        <td><?php echo $total; ?></td>
                                        <td><?php echo $order_date; ?></td>

                                        <td>
                                            <?php 
                                                if($status=="Ordered")
                                                {
                                                    echo "<label>$status</label>";
                                                }
                                                elseif($status=="On Delivery")
                                                {
                                                    echo "<label style='color: orange;'>$status</label>";       
                                                }
                                                elseif($status=="Delivered")
                                                {
                                                    echo "<label style='color: green;'>$status</label>";       
                                                }
                                                elseif($status=="Cancelled")
                                                {
                                                    echo "<label style='color: Red;'>$status</label>";       
                                                }
                                             ?>
                                        </td>

                                        <td><?php echo $customer_name; ?></td>
                                        <td><?php echo $customer_contact; ?></td>
                                        <td><?php echo $customer_email; ?></td>
                                        <td><?php echo $customer_address; ?></td>
                                        
                                    <td>
                                        <!-- <a href="#" class="btn-secondary">Update Order</a> -->
                                        <!-- <button type="button" class="btn-secondary">Update Order</button> -->
                                        <button type="button"  class="btn-secondary" onclick="document.location='<?php echo SITEURL; ?>Admin/update-order.php?id=<?php echo $id; ?>'">Update Order</button>
                    
                                    </td>
                                </tr>

                            <?php
                        }
                    }
                    else
                    {
                        //Order Not Available.
                        echo "<tr><td cospan='12' class='error'><b> Order Not Available. </b></td></tr>";
                    }
                
                ?>

           
            
            
        </table>
    </div>

    
</div>

<?php include('partials/footer.php'); ?>



