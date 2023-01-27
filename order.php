<?php include('partials-front/menu.php');?>

<?php
//check if food id is set
if(isset($_GET['food_id']))
{
    //get the food id and details
    $food_id = $_GET['food_id'];

    //Get the details of selected food
    $sql = "SELECT * FROM tbl_food WHERE id=$food_id";

    //Execute the query
    $res = mysqli_query($conn, $sql);

    //count rows
    $count = mysqli_num_rows($res);

    //check whether data is available
    if($count == 1)
    {
        //We have data in db
        //Get data from db
        $row = mysqli_fetch_assoc($res);

        $title = $row['tittle'];
        $price = $row['price'];
        $image_name = $row['image_name'];



    }
    else
    {
        //Redirect the page
        header('location:'.SITEURL);
    }

}
else
{
    //redirect to home page
    header('location:'.SITEURL);
}

?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method = "POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php
                            //check if image is available or not
                            if($image_name=="")
                            {
                                //image not availabe
                                echo "<div class = 'error'>Image not Available</div>";
                            }
                            else
                            {
                                //image available
                                ?>
                                 <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name;?>" alt="<?php echo $title;?>" class="img-responsive img-curve">
                                 <?php

                            }
                           
                        ?>
                        
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title;?></h3>
                        <input type="hidden" name ="food" value = "<?php echo $title;?>">

                        <p class="food-price">$<?php echo $price;?></p>

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="<?php echo $qty;?>" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. pius karanja" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 0743xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. gathu@gmail.com.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php
            if(isset($_POST['submit']))
            {
                //get all the values from form
                $food = $_POST['food'];
                
                $qty = $_POST['qty'];

                $total = $price * $qty; //total

                $order_date = date("y-m-d h:i:sa");//order date

                $status = "ordered";//ordered, on delivery, cancelled

                $customer_name = $_POST['full-name'];

                $customer_contact = $_POST['contact'];

                $customer_email = $_POST['email'];

                $customer_address = $_POST['address'];


                //save the order in database
                $sql2 = "INSERT INTO tbl_orders SET
                food = '$food',
                price = $price,
                qty = $qty,
                total = $total,
                order_date = '$order_date',
                status = '$status',
                customer_name = '$customer_name',
                customer_contact = '$customer_contact',
                customer_email = '$customer_email',
                customer_address = '$customer_address'
                ";

                //echo $sql2;

                //Execute the query
                $res2 = mysqli_query($conn, $sql2);

                //check if query is executed
                if($res2==true)
                {
                    //query executesd
                    $_SESSION['order'] = "<div class='success text-center'>Food ordered successfully</div>";
                    //redirect to home page
                    header('location:'.SITEURL);
                    ?>
                    <script>

                            alert "success text-center'>Food ordered successfully";
                        </script>
                    <?php
                }
                else
                {
                    //Failed to execute order
                    $_SESSION['order'] = "<div class='error text-center'>Failed to order food</div>";
                    //redirect to home page
                    header('location:'.SITEURL);


                }
            }
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include('partials-front/footer.php');?>