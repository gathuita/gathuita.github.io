<?php include('partials-front/menu.php');?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <?php
                //Get the search keyword
                //$search = $_POST['search'];
                $search = mysqli_real_escape_string($conn, $_POST['search']);
            
            ?>
            
            <h2>Foods on Your Search <a href="#" class="text-white"></a><?php echo $search;?></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                //get search keyword
                $search = mysqli_real_escape_string($conn, $_POST['search']);

                //sql to get food searched
                $sql = "SELECT * FROM tbl_food WHERE tittle LIKE '%$search%' OR description LIKE '%$search%'";

                //Execute the query
                $res = mysqli_query($conn, $sql);

                //count rows
                $count = mysqli_num_rows($res);

                //check rows
                if($count>0)
                {
                    while($row3 = mysqli_fetch_assoc($res))
                    {
                    $id = $row3['id'];
                    $title = $row3['tittle'];
                    $price = $row3['price'];
                    $description = $row3['description'];
                    $image_name = $row3['image_name'];
                    ?>
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php
                                    if($image_name=="")
                                    {
                                        //image not found
                                        echo "<div class = 'error'>Image Not available</div>";
                                    }
                                    else
                                    {
                                        ?>
                                            <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name;?>" alt="<?php echo $title?>" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>
                                
                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title?></h4>
                                <p class="food-price">$<?php echo $price;?></p>
                                <p class="food-detail">
                                    <?php echo $description;?>
                                </p>
                                <br>

                                <a href="<?php echo SITEURL;?>order.php" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>
                    <?php
                    }
                }
                else
                {
                    //No Searched food
                    echo "<div class = 'error'>No Searched food available</div>";
                }
            ?>

            

           

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php');?>