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

    <?php
        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
    ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php 
            //create sql query to display categories from db
            $sql = "SELECT * FROM tbl_category WHERE active = 'Yes' And featured='Yes' LIMIT 3";

            //Execute the query
            $res = mysqli_query($conn, $sql);

            //count rows to check if there are data in db
            $count = mysqli_num_rows($res);

            if($count>0)
            {
                while($rows=mysqli_fetch_assoc($res))
                {
                    //Get the values 
                    $id = $rows['id'];
                    $title = $rows['tittle'];
                    $image_name = $rows['image_name'];
                    ?>

                        <a href="<?php echo SITEURL;?>category-foods.php?category_id=<?php echo $id;?>">
                            <div class="box-3 float-container">
                                <?php
                                //check whether image is available or not
                                    if($image_name=="")
                                    {
                                        echo "<div class='error'>Image not Available</div>";
                                    }
                                    else
                                    {
                                        ?>
                                            <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name;?> " alt="<?php echo $title;?>" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>
                                

                                <h3 class="float-text text-white"><?php echo $title;?></h3>
                            </div>
                        </a>

                    <?php
                }
            }
            else
            {
                echo "<div class='error'>Category Not added</div>";
            }
            ?>




            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
            //query to get food from the db
            $sql3 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured = 'Yes' LIMIT 6";

            //Execute Query
            $res3 = mysqli_query($conn,$sql3);

            //count rows to get data from db

            $count3 = mysqli_num_rows($res3);

            if($count3>0)
            {
                //There is food data in db
                while($row3 = mysqli_fetch_assoc($res3))
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
                                //check whether image available
                                if($image_name =="")
                                {
                                    //image not available
                                    echo "<div class='error'>Image not Available</div>";
                                }
                                else
                                {
                                    ?>
                                        <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name;?> " alt="<?php echo $title;?>" class="img-responsive img-curve">
                                    <?php
                                }

                                
                                ?>
                            
                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title;?></h4>
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
                //No food data in db
                echo "<div class = 'error'>No food Available</div>";
            }
            ?>





            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->
<?php include('partials-front/footer.php');?>