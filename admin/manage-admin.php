
<!--Header starts-->
<?php include('parcels/menu.php');?>
<!--Header ends-->

        <!--Menu content section starts-->
        <div class="main-content">
        <div class="wrapper">
            <h1>Manage Admin</h1><br>
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
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset ($_SESSION['update']);
            }

            if(isset($_SESSION['user-not-found']))
            {
                echo $_SESSION['user-not-found'];
                unset($_SESSION['user-not-found']);
            }

            if(isset($_SESSION['pwd-not-match']))
            {
                echo $_SESSION['pwd-not-match'];
                unset($_SESSION['pwd-not-match']);
            }

            if(isset($_SESSION['change-pwd']))
            {
                echo $_SESSION['change-pwd'];
                unset($_SESSION['change-pwd']);
            }

            ?>
            <br><br>
            <!--Button to add Admin-->
            <a href="add-admin.php" class="btn-primary">Add Admin</a>
            <br>
            <table class="tbl-full">
                <tr>
                    <th>S.N</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Action</th>
                </tr>

                <?php
                //Query to get all admin
                $sql = "SELECT * FROM tbl_admin";
                //check whether query is executed or not
                $res = mysqli_query($conn, $sql);
                if($res==TRUE)
                {
                    //count number of rows to check whether we have data or not
                    $count = mysqli_num_rows($res);//function to get all rows in database
                    //check the number of rows
                    $sn=1;
                    if($count>0)
                    {
                        //we have data in the table
                        while($rows=mysqli_fetch_assoc($res))
                        {
                            //While loop will run as long as we have data in the database
                        //use while loop to display all the rows

                        //Get individual data
                        $id=$rows['id'];
                        $full_name=$rows['full_name'];
                        $username=$rows['username'];

                        // Display values in our table

                        ?>
                        <tr>
                        <td><?php echo $sn++;?>.</td>
                        <td><?php echo $full_name;?></td>
                        <td><?php echo $username;?></td>
                        <td>
                        <a href="<?php echo SITEURL;?>admin/update-password.php?id=<?php echo $id;?>" class="btn-primary">Change Password</a>
                        <a href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id;?>" class="btn-secondary">Update Admin</a>
                        <a href="<?php echo SITEURL;?>admin/delete-admin.php?id=<?php echo $id;?>" class="btn-danger"> Delete Admin</a>
                        </td> 
                        </tr>
                        <?php
                        }
                    }
                    else
                    {
                        //we dont have data in db
                    }
                }
                ?>
                
            </table>
            
            </div>
        </div>
        <!--Menu content section ends-->

        <!--footer section-->
        <?php include('parcels/footer.php');?>
        <!--footer ends -->
