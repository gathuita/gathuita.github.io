<?php include('partials-front/menu.php');?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL;?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                //Sql query to display food data from db
                $sql = "SELECT * FROM tbl_food";

                //Execute the query
                $res = mysqli_query($conn, $sql);

                //count rows to check if there exists data in db
                $count = mysqli_num_rows($res);

                //check if they exist
                if($count>0)
                {
                    //food data available
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
                                        if($image_name == "")
                                        {
                                            //image not available
                                            echo "<div class = 'errror'>Image Not found";
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

                                    <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>

                        <?php
                    }
                }
                else
                {
                    //food data not available
                    echo "<div class='error'>No food data Added yet";
                }
            ?>


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php');?>