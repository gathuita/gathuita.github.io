<?php
include('../config/constants.php');
//1. Get ths id of admin to be deleted
$id=$_GET['id'];
//echo $id;
//2. Create sql query to delete admin
$sql = "DELETE FROM tbl_admin WHERE id = $id";
//Execute the query
$res = mysqli_query($conn, $sql);
//check whether the query executed successfully
if($res==true)
{
    //echo "Admin Deleted successfully";
    $_SESSION['delete']='<div class="success">Admin Deleted successfully</div>';
    //Redirect to manage admin page
    header('location:'.SITEURL.'admin/manage-admin.php');
}
else
{
    //echo "Failed to delete admin";
    $_SESSION['delete']='<div class="errors">Failed to delete Admin</div>';
    //Redirect to manage admin page
    header('location:'.SITEURL.'admin/manage-admin.php');
}
//3. Rdirect to admin page with a message

?>