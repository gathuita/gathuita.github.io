<!--Header starts-->
<?php include('parcels/menu.php');?>
<!--Header ends-->

<!-- main content starts here-->
<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin<h1>
            <br>
            <?php
            $id = $_GET['id'];
            $sql = "SELECT * FROM tbl_admin WHERE id = $id";
            $res = mysqli_query($conn, $sql);
            
            if($res==true)
            {
                $count = mysqli_num_rows($res);
                if($count==1)
                {
                    echo "Adim Available";
                    $row = mysqli_fetch_assoc($res);

                    $full_name = $row['full_name'];
                    $username = $row['username'];
                }
                else
                {
                    //redirect to manage admin page
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }

            } 
            ?>
        <form action="" method="POST">
                <table class="tbl-30">
                    <tr>
                        <td>Full Name</td>
                        <td><input type="text" name="full_name" value="<?php echo $full_name;?>"></td>
                    </tr>
                    <tr>
                        <td>Username</td>
                        <td><input type="text" name="username" value="<?php echo $username;?>"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type='hidden' name='id' value="<?php echo $id;?>">
                            <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                        </td>
                    </tr>

                </table>
            </form>
    </div>

</div>
<?php
    //check whether submit button is clicked
    if(isset($_POST['submit']))
    {
        //echo "Button clicked";
        //Get all the values from form to update
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);

        // Create sql query to update Admin

        $sql = "UPDATE tbl_admin SET
        full_name = '$full_name',
        username = '$username'
        WHERE id ='$id'
        ";
        //Execute the query
        $res = mysqli_query($conn, $sql);

        //check whether the query executed successfuylly

        if($res==true)
        {
            $_SESSION['update'] = "<div class='success'>Admin updated successfully</div>";
            //redirect to manage-admin page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
        else
        {
            $_SESSION['update'] = "<div class='error'>Admin Failed to update</div>";
            //redirect to manage-admin page
            header('location:'.SITEURL.'admin/manage-admin.php');   
        }
    }
    
?>
<!--footer section-->
<?php include('parcels/footer.php');?>
<!--footer ends -->