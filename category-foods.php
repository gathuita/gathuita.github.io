
<?php include('partials-front/menu.php');?>




<?php
//check whether id is passed or not
if(isset($_GET['category_id']))
{
    //category id is set and get the id
    $category_id = $_GET['category_id'];
    //Get category title based on category id
    $sql = "SELECT tittle FROM tbl_category WHERE id = $category_id";

    //Execute the query
    $res = mysqli_query($conn, $sql);

    //Get values from db
    $row = mysqli_fetch_assoc($res);

    //Get title
    $category_title = $row['tittle'];
}
else
{
    //category id is not set
    //redirect to home page
    header('location:'.SITEURL);
}
?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white"><?php echo $category_title;?></a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                //Create sql to display categories
                $sql2 = "SELECT * FROM tbl_food WHERE category_id = $category_id";

                //Execute the query
                $res2 = mysqli_query($conn, $sql2);

                //count rows
                $count2 = mysqli_num_rows($res);

                //check whether food is available or not
                if($count2>0)
                {
                    while($row2 = mysqli_fetch_assoc($res2))
                        {
                            $title = $row2['tittle'];
                            $price = $row2['price'];
                            $description = $row2['description'];
                            $image_name = $row2['image_name'];
                            ?>

                                <div class="food-menu-box">
                                    <div class="food-menu-img">
                                        <?php
                                            //check if image is available
                                            if($image_name == "")
                                            {
                                                //Image not Anvailabe
                                                echo "<div class='error'>Image not Available</div>";
                                            }
                                            else
                                            {
                                                ?>
                                                    <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name;?>" alt="<?php echo $title;?>" class="img-responsive img-curve">
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
                    echo "<div class='error'>No food Available for that Category</div>";
                    echo $title;
                }

               
            ?>


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php');?>