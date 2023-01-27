<?php include('parcels/menu.php'); ?>


<div class = "main-content">
    <div class="wrapper">
        <h1>Update Food</h1>

        <br><br>
        <?php
            //check if id is set or not
            if(isset($_GET['id']))
            {
                //Get all the details
                $id = $_GET['id'];

                //sql query to get the details
                $sql2 = "SELECT * FROM tbl_food WHERE id = $id";

                //Execute the query
                $res2 = mysqli_query($conn, $sql2);


                //Get the values
                
                $row2 = mysqli_fetch_assoc($res2);
                
                //get values of selected food
                $title = $row2['tittle'];
                $description = $row2['description'];
                $price = $row2['price'];
                $current_image = $row2['image_name'];
                $current_category = $row2['category_id'];
                $featured = $row2['featured'];
                $active = $row2['active'];


            }
            else
            {
                //Redirect to manage page with session message
                header('location:'.SITEURL.'admin/manage-food.php');
            }


            ?>

        <form action="" method="POST" enctype="multitype/form-data" >
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="tittle" value = "<?php echo $title;?>">
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5"><?php echo $description;?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                    <input type="number" name="price" value ="<?php echo $price;?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                        if($current_image == "")
                        {
                            //image not available
                            echo "<div class='error'>Image Not Available</div>";
                        }
                        else
                        {
                            //image available
                            ?>
                            <img src="<?php echo SITEURL;?>images/food/<?php echo $current_image; ?>" width = "100px" height="100px">
                            <?php
                        }
                        
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Select New Image:</td>
                    <td>
                    <input type="file" name="image" value="<?php echo $image_name;?>">
                    </td>
                </tr>

                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category_id">
                            <?php
                                //Create php code to get the categories from the database
                                //1. create a sql query to get all active categories
                                $sql ="SELECT * FROM tbl_category WHERE active='Yes'";

                                //Exescute the query
                                $res = mysqli_query($conn, $sql);
                                
                                //count the rows to check whether we have categories or not
                                $count = mysqli_num_rows($res);

                                if($count>0)
                                {
                                    //we have categories
                                    while($row = mysqli_fetch_assoc($res))
                                    {
                                        $category_id = $row['id'];
                                        $category_title = $row['tittle'];
                                        ?>
                                        <option <?php if($current_category == $category_id){echo "selected";} ?>value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                        <?php
                                    }
                                }
                                else
                                {
                                    //we dont have categories
                                    ?>
                                    <option value="0">No Category Found</option>
                                    <?php

                                }
                            ?>

                        </select>
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
                        <input <?php if($active=='Yes'){echo "checked";}?> type="radio" name="active" value="Yes"> Yes
                        <input <?php if($active=='No'){echo "checked";}?> type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value = "<?php echo $id;?>">
                        <input type="hidden" name="current_image" value = "<?php echo $current_image;?>">
                        <input type="submit" name="submit" value = "Update Food" class="btn-secondary">
                    </td>
                </tr>


            </table>
        </form>

        <?php
if(isset($_POST['submit']))
{
    //echo "Button clicked";
    //1.Get all the data
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $title = mysqli_real_escape_string($conn, $_POST['tittle']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $current_image = mysqli_real_escape_string($conn, $_POST['current_image']);
    //$category = $_POST['category_id'];
    $featured = mysqli_real_escape_string($conn, $_POST['featured']);
    $active = mysqli_real_escape_string($conn, $_POST['active']);

    //2.Upload image if selected
    //check whether the upload button is clicked or not
    if(isset($_FILES['image']['name']))
    {
        //upload btn clicked
        $image_name = $_FILES['image']['name'];//new image

        //check whether file is available or not
        if($image_name != "")
        {
            //Image is available
            //Rename the image
            $ext = end(explode('.', $image_name));//gets the images extension

            $image_name = "Food_Name_updated".rand(000, 999).'.'.$ext;//rename image

            //Get the source and destination path

            $src_path = $_FILES['image']['tmp_name'];//source path

            $dest_path = "../images/food".$image_name;//destination path

            //upload image
            $upload = move_uploaded_file($src_path,$dest_path);

            //check if image is uploaded
            if($upload==false)
            {
                //Failed to upload
                $_SESSION['upload'] = "<div class='error'>Failed to upload new image</div>";
                //redirect to manage food
                header('location:'.SITEURL.'admin/manage-food.php');
                //kill the process
                die();

            }
            //3.Remove current image if exist and upload new image
            if($current_image !="")
            {
                //current image is available
                //Remove the image
                $remove_path = "../images/food".$current_image;

                $remove = unlink($remove_path);

                //check if image is remved or not
                if($remove==false)
                {
                    //Failed to remove current image
                    $_SESSION['remove-failed'] = "<div class='error'>Failed to remove current image</div>";
                    //redirect to manage food
                    header('location:'.SITEURL.'admin/manage-food.php');
                    //kill the process
                    die();
                }
                else
                {
                    //Failed to remove current image
                    $_SESSION['remove-failed'] = "<div class='error'>current image removed successfully</div>";
                    //redirect to manage food
                    header('location:'.SITEURL.'admin/manage-food.php');

                }

            }
        }
        else
        {
            $current_image = $image_name;
        }
    }
    else
    {
        $image_name = $current_image;
    }
   // if(isset($_POST['submit'])){
    
    //4.Update food in Database
    $sql3 = "UPDATE tbl_food SET
    tittle = '$title',
    description = '$description',
    price = $price,
    image_name= ='$image_name',
    featured = '$featured',
    active= '$active'
    WHERE id = $id
    ";
    //Execute the query
    $res3 = mysqli_query($conn, $sql3);

    //check if query is executed or not
    if($res3 == true)
    {
        //display success message
        $_SESSION['update'] = "<div class = 'success'>Food Updated Successfully</div>";
        //redirect to manage food page
        header('location:'.SITEURL.'admin/manage-food.php');
    }
    else
    {
        //display error message
        $_SESSION['update'] = "<div class = 'error'>Failed to  Update Food</div>";
        //redirect to manage food page
       //header('location:'.SITEURL.'admin/manage-food.php');

    }
    //Redirect the page

}
//}

?>

       
            </div>
        </div>

        <?php include('parcels/footer.php');