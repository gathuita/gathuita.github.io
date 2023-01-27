<!--Header starts-->
<?php include('parcels/menu.php');?>
<!--Header ends-->
 <!--Menu content section starts-->
 <div class="main-content">
        <div class="wrapper">
            <div class="form-design">
            <h1>Add Admin</h1><br>

            <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];//display sesion message
                unset($_SESSION['add']);//remove session message
            }
             ?>

            <form action="" method="POST">
                <table class="tbl-30">
                    <tr>
                        <td>Full Name</td>
                        <td><input type="text" name="full_name" placeholder="Enter your full name"></td>
                    </tr>
                    <tr>
                        <td>Username</td>
                        <td><input type="text" name="username" placeholder="Enter your username"></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td><input type="password" name="password" placeholder="Enter your password"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                        </td>
                    </tr>

                </table>
            </form>
            </div>
            </div>
        </div>
        <!--Menu content section ends-->
<!--footer section-->
<?php include('parcels/footer.php');?>
<!--footer ends -->
<!--process data from form-->
<?php
//process the values and save it to the db.
//check whether the submit button is clicked
if(isset($_POST['submit']))
{
    //button clicked
    //echo "Button clicked";
    //1. Get the data from form
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    //2. Sql to save values into the database
    $sql = "INSERT INTO tbl_admin SET
    full_name='$full_name',
    username='$username',
    password='$password'";
    //echo $sql;
    //3. Execute query and save data in db
    $res = mysqli_query($conn, $sql) or die(mysql_error());
    //4. check whether query is executed or not
    if($res==true)
    {
        //echo 'Data inserted successfully';
        //create a session variable to display message
        $_SESSION['add']='Admin Added Successfully';
        //redirect page
        header("location:".SITEURL.'admin/manage-admin.php');
    }
    else
    {
        //echo "Data NoT inserted";
                //create a session variable to display message
                $_SESSION['add']='Failed to add Admin';
                //redirect page
                header("location:".SITEURL.'admin/add-admin.php');
    }
}

?>