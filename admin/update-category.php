<?php include('parcels/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br><br>
        <?php
            //check whether id is set or not
            if(isset($_GET['id']))
            {
                //get all other details
                //echo "Getting the data";
                $id = $_GET['id'];
                //create sql query to get all the other details
                $sql = "SELECT * FROM tbl_category WHERE id = $id";

                //execute the query
                $res = mysqli_query($conn, $sql);

                //count the number of rows to check if there exists data

                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    //Get all the data
                    $row = mysqli_fetch_assoc($res);
                    $tittle = $row['tittle'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];

                }
                else
                {
                    //redirect to tha manage category page with session message
                    $_SESSION['no-category-found'] = "<div class='error'>Category Not Found</div>";
                    //redirect to tha manage category page
                    header('location:'.SITEURL.'admin/manage-category.php');

                }
            }
            else
            {
                //redirect to manage category
                header('location:'.'admin/manage-category.php');
            }
        ?>
        <!--form starts here-->
        <form action="" method="POST" enctype = "multitype/form-data">
        <table class="tbl-30">
            <tr>
                <td>Title:</td>
                <td>
                    <input type="text" name="tittle" value="<?php echo $tittle;?>">
                </td>
            </tr>
            <tr>
                <td>Current Image:</td>
                <td>
                    <?php
                        if($current_image != "")
                        {
                            //Display the message
                            ?>
                            <img src="<?php echo SITEURL;?>images/category/<?php echo $current_image;?>"width=100px height=100px>
                            <?php
                        }

                        else
                        {
                            //Display Message
                            echo "<div class='error'>Image Not Added</div>";
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td>New Image:</td>
                <td>
                    <input type="file" name="image" value="<?php echo $image_name;?>">
                </td>
            </tr>
            <tr>
                <td>Featured:</td>
                <td>
                    <input <?php if($featured=="Yes"){echo "checked";}?> type="radio" name="featured" value="Yes"> Yes
                    <input <?php if($featured=="No"){echo "checked";}?> type="radio" name="featured" value="No"> No
                </td>
            </tr>
            <tr>
                <td>Active:</td>
                <td>
                    <input <?php if($active=="Yes"){echo "checked";}?> type="radio" name="active" value="Yes"> Yes
                    <input <?php if($active=="No"){echo "checked";}?> type="radio" name="active" value="No"> No
                </td>
            </tr>
            <tr>
                <td>
                    <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                    <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                </td>
            </tr>

        </table>
        </form>
        <!--Form ends here-->
        <?php
            if(isset($_POST['submit']))
            {
                //echo "clicked";
                //1. get allthe values from form
                $id= mysqli_real_escape_string($conn, $_POST['id']);
                $tittle=mysqli_real_escape_string($conn, $_POST['tittle']);
                $current_image=mysqli_real_escape_string($conn, $_POST['current_image']);
                $featured= mysqli_real_escape_string($conn, $_POST['featured']);
                $active=mysqli_real_escape_string($conn, $_POST['active']); 
                
                //2. Updating new image if selected
                //check whether the image is selected or not
                if(isset($_FILES['image']['name']))
                {
                    //Get image details\
                    $image_name = $_FILES['image']['name'];
                    //check if image is available
                    if($image_name != "")
                    {
                        //image available
                        //A. upload the new image
                        //Auto rename image
                        $ext = end(explode('.', $image_name));

                        $image_name = "Food_category_".rand(000,999).'.'.$ext;//e.g Food_category_001.jpg
                        
                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/category/".$image_name;

                        //finally upload the image
                        $upload = move_uploaded_file($source_path,$destination_path);

                        //check whether the image is uploaded or not
                        //And if image is not uploaded then we will stop the process and redirect with error message
                        if($upload==false)
                            {
                                $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                                //redirect to category page
                                header('location:'.SITEURL.'admin/manage-category.php');
                                die();
                            }
                        //B. remove the current image if available
                        if($current_image!="")
                            {
                                $remove_path = "../images/category/".$current_image;

                                $remove = unlink($remove_path);

                                //check if image is removed or not
                                if($remove==false)
                                {
                                    //Failed to remove image
                                    $_SESSION['failed-remove'] = "<div class='error'>Failed to Remove image</div>";
                                    header('location:'.SITEURL.'admin/manage-category.php');
                                    die();
                                }
                            }

                    }
                    else
                    {
                        $image_name = $current_image;
                    }
                }
                else
                {
                    $image_name = $current_image;
                }
                //3. update the database
                $sql2 = "UPDATE tbl_category SET
                tittle = '$tittle',
                image_name = '$image_name',
                featured = '$featured',
                active = '$active'
                WHERE id = $id
                ";

                //Execute the query
                $res2 = mysqli_query($conn, $sql2);

                if($res2==true)
                {
                    //category updated
                    $_SESSION['update'] = "<div class='success'>Category updated Successfully</div>";
                    //Redirect the page to manage category
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    //category updated
                    $_SESSION['update'] = "<div class='error'>Category  Failed to update</div>";
                    //Redirect the page to manage category
                    header('location:'.SITEURL.'admin/manage-category.php');
                }

            }
        ?>
    </div>

</div>
<?php include('parcels/footer.php');?>