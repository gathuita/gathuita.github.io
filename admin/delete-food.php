<?php
include('../config/constants.php');
//check whether the id and image name is passed
if(isset($_GET['id']) AND isset($_GET['image_name']))
{
    //get the value and delete
    //echo "Get value and delete";
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    //Remove the image file if available
    if($image_name != "")
    {
        //image is available
        $path = "../images/food/".$image_name;

        //Remove the page
        $remove = unlink($path);


        //If failed to remove 
        if($remove==false)
        {
            //set the session message
            $_SESSION['remove'] = "<div class = 'error'>Failed to remove Image</div>";
            //Redirect to manage category page
            header('location:'.SITEURL.'admin/manage-food.php');
            //stop the process
            die();
        }
    }

    //Delete data from database
    //sql query delete data from database
    $sql = "DELETE FROM tbl_food WHERE id=$id";

    //Execute query
    $res = mysqli_query($conn, $sql);

    //Check if the query has executed is success
    if($res==true)
    {
        //set success message and redirect
        $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully</div>";
        
        //Redirect to manage category
        header('location:'.SITEURL.'admin/manage-food.php');
    }
    else
    {
        //set success message and redirect
        $_SESSION['delete'] = "<div class='success'>Failed to Delete Food</div>";

        //Redirect to manage category
        header('location:'.SITEURL.'admin/manage-food.php');
    }
    //Redirect to category page

}
else
{
    //Redirect to manage category page
    header('location:'.SITEURL.'admin/manage-food.php');
}
?>