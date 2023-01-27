
<!--Header starts-->
<?php include('parcels/menu.php');?>
<!--Header ends-->
        <!--Menu content section starts-->
        <div class="main-content">
        <div class="wrapper">
            <h1>Manage Food</h1><br>
            <?php
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];
                    unset ($_SESSION['delete']);
                }
                if(isset($_SESSION['remove']))
                {
                    echo $_SESSION['remove'];
                    unset ($_SESSION['remove']);
                }
                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset ($_SESSION['update']);
                }
                if(isset($_SESSION['remove-failed']))
                {
                    echo $_SESSION['remove-failed'];
                    unset ($_SESSION['remove-failed']);
                }

            ?>
            <br><br>
            <!--Button to add Admin-->
            <a href="add-food.php" class="btn-primary">Add Food</a>
            <br>
            <table class="tbl-full">
                <tr>
                    <th>S.N</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>
                <?php
                    //Sql quert to get all the data
                    $sql = "SELECT * FROM tbl_food";

                    //Execute the query
                    $res = mysqli_query($conn, $sql);

                    $count = mysqli_num_rows($res);
                    $sn = 1;

                    //count rows
                    if($count>0)
                    {
                        //Food available in db
                        while($row=mysqli_fetch_assoc($res))
                        {
                            $id = $row['id'];
                            $tittle = $row['tittle'];
                            $description = $row['description'];
                            $price = $row['price'];
                            $image_name = $row['image_name'];
                            $featured = $row['featured'];
                            $active = $row['active'];
                            ?>

                            <tr>
                                <td><?php echo $sn++;?></td>
                                <td><?php echo $tittle;?></td>
                                <td><?php echo $description; ?></td>
                                <td><?php echo $price; ?></td>
                                <td>
                                    <?php 
                                        if($image_name=="")
                                        {
                                            //image not found
                                            echo "<div class = 'error'>Image Not Found</div>";

                                        }
                                        else
                                        {
                                            ?>
                                            <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name; ?>" width = "100px" height="100px">
                                            <?php
                                        }
                                    ?>
                                </td>
                                <td><?php echo $featured; ?></td>
                                <td><?php echo $active;?></td>
                                <td>
                                <a href="<?php echo SITEURL;?>admin/update-food.php?id=<?php echo $id;?>" class="btn-secondary">Update Food</a>
                                <a href="<?php echo SITEURL;?>admin/delete-food.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class="btn-danger"" class="btn-danger"> Delete Food</a>
                                </td>
                            </tr>

                            <?php
                        }
                         
                    }
                    else
                    {
                        //Food not added yet in db

                        echo "<div class = 'error'>Food Not Added In database Yet</div>";
                    }
                
                ?>

            </table>
            </div>
        </div>
        <!--Menu content section ends-->
<!--footer section-->
<?php include('parcels/footer.php');?>
<!--footer ends -->