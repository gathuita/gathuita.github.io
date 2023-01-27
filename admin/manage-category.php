
<!--Header starts-->
<?php include('parcels/menu.php');?>
<!--Header ends-->
        <!--Menu content section starts-->
        <div class="main-content">
        <div class="wrapper">
            <h1>Manage Category</h1><br>
            <br>
            <?php
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset ($_SESSION['add']);
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
                if(isset($_SESSION['no-category-found']))
                {
                    echo $_SESSION['no-category-found'];
                    unset ($_SESSION['no-category-found']);
                }
                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset ($_SESSION['update']);
                }
                if(isset($_SESSION['upload']))
                {
                    echo $_SESSION['upload'];
                    unset ($_SESSION['upload']);
                }
                if(isset($_SESSION['failed-remove']))
                {
                    echo $_SESSION['failed-remove'];
                    unset ($_SESSION['failed-remove']);
                }
            ?>
            <br><br> 
            <!--Button to add Admin-->
            <a href="<?php echo SITEURL;?>admin/add-category.php" class="btn-primary">Add Category</a>
            <br>
            <table class="tbl-full">
                <tr>
                    <th>S.N</th>
                    <th>Title</th>
                    <th>image name</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>

                <?php
                    //Query to get all Categories
                    $sql = "SELECT * FROM tbl_category ORDER BY id DESC";

                    //Execute the query
                    $res=mysqli_query($conn, $sql);

                    if($res==true)

                    $count = mysqli_num_rows($res);
                    $sn = 1;

                    if($count>0)
                    {
                        
                        //$title = $_POST['title'];
                        //We have data in the db
                        while($rows=mysqli_fetch_assoc($res))
                        {
                            $id = $rows['id'];
                            $tittle = $rows['tittle'];
                            $image_name = $rows['image_name'];
                            $featured = $rows['featured'];
                            $active = $rows['active'];


                            ?>
                            <tr>
                            <td><?php echo $sn++;?></td>
                            <td><?php echo $tittle;?></td>
                            <td>
                                <?php
                            if($image_name!="")
                            {
                                //Display image
                                ?>
                                <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name;?>"width="100px" height="100px">
                                <?php
                            }
                            else
                            {
                                //Display the message
                                echo "<div class = 'error'>Image Not Added</div>";
                            }
                            ?>
                            </td>
                            <td><?php echo $featured;?></td>
                            <td><?php echo $active;?></td>
                            <td>
                            <a href="<?php echo SITEURL;?>admin/update-category.php?id=<?php echo $id;?>" class="btn-secondary">Update Category</a>
                            <a href="<?php echo SITEURL;?>admin/delete-category.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class="btn-danger"> Delete Category</a>
                            </td>
                            </tr>
                    <?php
                }
            }
            else
            {
                //We do not have data
                //display message inside table
                ?>
                <tr>
                <td colspan="6"><div class="error"> Empty! Category Added</div></td>
                </tr>
                <?php
            }
//
        //}
                ?>
                
            </table>
            </div>
        </div>
        <!--Menu content section ends-->
<!--footer section-->
<?php include('parcels/footer.php');?>
<!--footer ends -->