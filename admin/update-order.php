<?php include('parcels/menu.php')?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br><br>
        <?php
            //check if id is set
            if(isset($_GET['id']))
            {
                //id is set
                //get the id
                $id = $_GET['id'];
                //Get all other order details based on this id
                //sql query to get the data
                $sql = "SELECT * FROM tbl_orders WHERE id=$id";

                //Execute query
                $res = mysqli_query($conn, $sql);
                //count rows
                $count = mysqli_num_rows($res);

                if($count == 1)
                {
                    $row = mysqli_fetch_assoc($res);

                    $food = $row['food'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address'];
                }
                else
                {
                    //No orders available yet
                    echo "<div class='error'> No orders Available yet</div>";
                }
            }
            else
            {
                //id not set
                //rediect to home page
                header('location:'.SITEURL.'admin/manage-order.php');
            }
        ?>
        
        <form action="" method = "POST">
            <table class ="tbl-30">
            <tr>
                <td>Food Name:</td>
                <td><b><?php echo $food;?></b></td>
            </tr>
            <tr>
                <td>Food Price:</td>
                <td><b>$<?php echo $price;?></b></td>
            </tr>
            <tr>
                <td>Qty:</td>
                <td>
                    <input type="number" name = "qty" value ="<?php echo $qty;?>">
                </td>
            </tr>
            <tr>
                <td>Status:</td>
                <td>
                    <select name="status" id="">
                        <option <?php if($status=="ordered"){echo "selected";}?>value="ordered">Ordered</option>
                        <option <?php if($status=="on delivery"){echo "selected";}?>value="on delivery">On Delivery</option>
                        <option <?php if($status=="delivered"){echo "selected";}?>value="delivered">Delivered</option>
                        <option <?php if($status=="cancelled"){echo "selected";}?>value="cancelled">Cancelled</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td> Customer Name:</td>
                <td>
                    <input type="text" name = "customer_name" value ="<?php echo $customer_name;?>">
                </td>
            </tr>
            <tr>
                <td> Customer Contact:</td>
                <td>
                    <input type="text" name = "customer_contact" value ="<?php echo $customer_contact;?>">
                </td>
            </tr>
            <tr>
                <td> Customer Email:</td>
                <td>
                    <input type="text" name = "customer_email" value ="<?php echo $customer_email;?>">
                </td>
            </tr>
            <tr>
                <td> Customer Address:</td>
                <td>
                    <textarea name="customer_address" id="" cols="30" rows="5"><?php echo $customer_address;?></textarea>

                </td>
            </tr>
            <tr>
                <td colspan='2'>
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                    <input type="hidden" name="price" value="<?php echo $price;?>">
                    <input type="submit" name = "submit" value = "Update Order" class="btn-secondary">
                </td>
            </tr>
            </table>
        </form>

        <?php
        //check whether update button is clicked or not
        if(isset($_POST['submit']))
        {
            echo "clicked";
            //Get all the values from form
            $id = mysqli_real_escape_string($conn, $_POST['id']);
            $price = mysqli_real_escape_string($conn, $_POST['price']);
            $qty = mysqli_real_escape_string($conn, $_POST['qty']);
            $total = $price * $qty;
            $status = mysqli_real_escape_string($conn, $_POST['status']);

            $customer_name =  mysqli_real_escape_string($conn, $_POST['customer_name']);
            $customer_contact =  mysqli_real_escape_string($conn, $_POST['customer_contact']);
            $customer_email =  mysqli_real_escape_string($conn, $_POST['customer_email']);
            $customer_address =  mysqli_real_escape_string($conn, $_POST['customer_address']);

            //Query to update order
            $sql2 = "UPDATE tbl_orders SET
            
            qty = $qty,
            total = $total,
            status = '$status',
            customer_name = '$customer_name',
            customer_contact = '$customer_contact',
            customer_email = '$customer_email',
            customer_address = '$customer_address'
            WHERE id=$id
            
            ";

            //execute query
            $res2 = mysqli_query($conn, $sql2);

            //check if updated or not
            //redirect
            if($res2==true)
            {
            $_SESSION['update'] = "<div class='success'>Order updated Successfully.</div";
            header('location:'.SITEURL.'admin/manage-order.php');
            }
            else
            {
                //failed
                $_SESSION['update'] = "<div class='error'>Failed to update Order.</div";
                header('location:'.SITEURL.'admin/manage-order.php');
            }
        }

        
        ?>

    </div>

</div>
<?php include('parcels/footer.php')?>