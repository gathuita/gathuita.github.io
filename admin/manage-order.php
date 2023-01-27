
<!--Header starts-->
<?php include('parcels/menu.php');?>
<!--Header ends-->
        <!--Menu content section starts-->
        <div class="main-content">
        <div class="wrapper">
            <h1>Manage Order</h1><br>
            <br>
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
                    <th>S.N</th>
                    <th>Food</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th>order Date</th>
                    <th>Status</th>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
                <?php
                //create sql query
                    $sql = "SELECT * FROM tbl_orders ORDER BY id DESC";

                    //Execute the query
                    $res = mysqli_query($conn, $sql);

                    //Count the rows
                    $count = mysqli_num_rows($res);

                    $sn = 1;

                    if($count>0)
                    {
                        //order available
                        while($row=mysqli_fetch_assoc($res))
                        {
                            //Get all the orders details
                            $id = $row['id'];
                            $food = $row['food'];
                            $price = $row['price'];
                            $qty = $row['qty'];
                            $total = $row['total'];
                            $order_date = $row['order_date'];
                            $status = $row['status'];
                            $customer_name = $row['customer_name'];
                            $Customer_contact = $row['customer_contact'];
                            $customer_email = $row['customer_email'];
                            $customer_address = $row['customer_address'];
                            ?>
                                <tr>
                                    <td><?php echo $sn++;?></td>
                                    <td><?php echo $food;?></td>
                                    <td><?php echo $price;?></td>
                                    <td><?php echo $qty;?></td>
                                    <td><?php echo $total;?></td>
                                    <td><?php echo $order_date;?></td>
                                    <td>
                                        <?php 
                                        //ordered status, On deliver,delivered, cancelled
                                        if($status=="ordered")
                                        {
                                            echo "<label>$status<label>";
                                        }
                                        elseif($status =="on delivery")
                                        {
                                            echo "<label style='color:orange;'>$status<label>";
                                        }
                                        elseif($status =="delivered")
                                        {
                                            echo "<label style='color:green;'>$status<label>";
                                        }
                                        elseif($status =="cancelled")
                                        {
                                            echo "<label style='color:red;'>$status<label>";
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $customer_name;?></td>
                                    <td><?php echo $Customer_contact;?></td>
                                    <td><?php echo $customer_email;?></td>
                                    <td><?php echo $customer_address;?></td>
                                    <td>
                                    <a href="<?php echo SITEURL;?>admin/update-order.php?id=<?php echo $id;?>" class="btn-secondary">Update Order</a>
                                    </td>
                                </tr>
                            <?php
                        }
                    }
                    else
                    {
                        //Order not available
                        echo "<tr><td colspan='12' class='error'>Orders Not Available Yet</td></tr>";
                    }

                ?>


            </table>
            </div>
        </div>
        <!--Menu content section ends-->
<!--footer section-->
<?php include('parcels/footer.php');?>
<!--footer ends -->