<!--Header starts-->
<?php include('parcels/menu.php');?>
<!--Header ends-->
<!-- main content starts here-->
<div class="main-content">
    <div class="wrapper">
        <h1>change Password<h1>
            <br>
            <?php
                if(isset($_GET['id']))
                {
                    $id = $_GET['id'];
                } 
            ?>
            <form method="POST">
                <table class="tbl-30">
                    <tr>
                        <td>Current password</td>
                        <td>
                            <input type="password" name="current_password" placeholder="current password">
                        </td>
                    </tr>
                    <tr>
                        <td>New password</td>
                        <td>
                            <input type="password" name="new_password" placeholder="new password">
                        </td>
                    </tr>
                    <tr>
                        <td>Confirm password</td>
                        <td>
                            <input type="password" name="confirm_password" placeholder="confirm password">
                        </td>
                    </tr>
                    <tr colspan="2">
                        <td>
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
        </div>

</div>
<?php
//check wherther the submit button is clicked
if(isset($_POST['submit']))
{
    //1. Get data from form
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $pwd = md5($_POST['current_password']);
    $current_password = mysqli_real_escape_string($conn, $pwd);
    $new_pwd = md5($_POST['new_password']);
    $new_password = mysqli_real_escape_string($conn,$new_pwd);
    $confirm_pwd = md5($_POST['confirm_password']);
    $confirm_password = mysqli_real_escape_string($conn, $confirm_pwd);


    //2. check whether admin with current password exists
    $sql = "SELECT * FROM tbl_admin WHERE id = $id AND password='$current_password'";

    //3. Execute the query
    $res1 = mysqli_query($conn, $sql);

    //check whether the query executed successfuylly
    if($res1==true)
    {
        $count = mysqli_num_rows($res1);
        if($count==1)
        {
    //echo "User found";
    //check if new pass match confirm pass
    if($current_password==$new_password)
    {
        //display session message
        $_SESSION['change-pwd'] = "<div class='success'>New Password cannot be same as current password</div>";
        //redirect page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else if($new_password==$confirm_password)
    {
        //match
        $sql1 = "UPDATE tbl_admin SET
        password = '$new_password' 
        WHERE id = '$id'
        ";

        $res = mysqli_query($conn, $sql1);

        if($res==true)
        {
            //display session message
            $_SESSION['change-pwd'] = "<div class='success'>Password changed successfully</div>";
            //redirect page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
        else
        {
            //display session message
            $_SESSION['change-pwd'] = "<div class='error'>Password NOT changed</div>";
            //redirect page
            header('location:'.SITEURL.'admin/manage-admin.php');  
        }
    }
    else
    {
        //display session message
        $_SESSION['pwd-not-match'] = "<div class='error'>Password did Not Match</div>";
        //redirect page
        header('location:'.SITEURL.'admin/manage-admin.php');

    }



       
    }
    else
    {
        //echo "User not found";
        $_SESSION['user-not-found'] = "<div class='error'>User Not Found</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
}
}
?>
<!--footer section-->
<?php include('parcels/footer.php');?>
<!--footer ends -->