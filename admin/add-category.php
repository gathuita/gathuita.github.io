<!--Header starts-->
<?php include('parcels/menu.php');?>
<!--Header ends-->

 <!--Menu content section starts-->
 <div class="main-content">
        <div class="wrapper">
            <div class="form-design">
            <h1>Add Category</h1><br>
                <br>
                <?php
                    if(isset($_SESSION['add']))
                        {
                            echo $_SESSION['add'];
                            unset ($_SESSION['add']);
                        }
                        if(isset($_SESSION['upload']))
                        {
                            echo $_SESSION['upload'];
                            unset ($_SESSION['upload']);
                        }
                ?>
                <br>

            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title:</td>
                        <td>
                            <input type="text" name="tittle" placeholder="Enter category Title">
                        </td>
                    </tr>
                    <tr>
                        <td>Select Image:</td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>
                    <tr>
                        <td>Featured:</td>
                        <td>
                            <input type="radio" name ="featured" value="Yes"> Yes
                            <input type="radio" name = "featured" value="No"> No

                        </td>
                        
                    </tr>
                    <tr>
                        <td>Active:</td>
                        <td>
                            <input type="radio" name = "active" value="Yes">Yes
                            <input type="radio" name = "active" value="No">No

                        </td>
                        
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                        </td>
                    </tr>

                </table>
            </form>

            <!--Add category form ends  here-->
            <!--Add category form process starts-->
            <?php
            if(isset($_POST['submit']))
            {
                $tittle = $_POST['tittle'];
                if(isset($_POST['featured']))
                {
                    //get the value
                    $featured=$_POST['featured'];
                }
                else
                {
                    //set the default value
                    $featured = "No";
                }
            }
                if(isset($_POST['active']))
                {
                    //get the value
                    $active = $_POST['active'];
                }
                else
                {
                    //set default value
                    $active = "No";
                }
            //}
            //check whether image is selected or not
            //print_r($_FILES['image']);
            //die();//break the code
            if(isset($_FILES['image']['name']))
            {

                //upload the image
                //To upload the image we need image name path and destination path
                $image_name = $_FILES['image']['name'];
                //upload image if only image name is AVAILABLE
                    if($image_name != "")
                        {
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
                                header('location:'.SITEURL.'admin/add-category.php');
                                die();
                            }
                    }
            }
            else
            {
                //dont upload the image and set image name as blank
                $image_name = "";
            }

            //create sql query to insert category into the db
            
            $sql = "INSERT INTO tbl_category SET 
            tittle = '$tittle',
            image_name = '$image_name',
            featured = '$featured',
            active = '$active'
            ";

            //3. execute the query
            $res1 = mysqli_query($conn, $sql);

            //4. check if the query is executed

            if($res1==true)
            {
                //Display the session message
                $_SESSION['add'] = "<div class='success'>Category added successfully</div>";
                //redirect the page
                header('location:'.SITEURL.'admin/manage-category.php');
            }
            else
            {
                //Display the session message
                $_SESSION['add'] = "<div class='error'>Failed to add Category</div>";
                //redirect the page
                //header('location:'.SITEURL.'admin/add-category.php');
            }
            ?>
            <!--Add category form process ends-->

            </div>
            </div>
        </div>
        <!--Menu content section ends-->
<!--footer section-->
<?php include('parcels/footer.php');?>
<!--footer ends -->