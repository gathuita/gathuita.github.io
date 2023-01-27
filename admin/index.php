<!--Header starts-->
<?php include('parcels/menu.php');?>
<!--Header ends-->
        <!--Menu content section starts-->
        <div class="main-content">
        <div class="wrapper">
            <h1>Dashboard</h1><br>
            <?php
            if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            } 
            ?>
            <div class="col-4 center">
                <?php
                    //SQL Query
                    $sql = "SELECT * FROM tbl_category";

                    //Execute the query
                    $res = mysqli_query($conn, $sql);
                     //COunt rows
                    $count = mysqli_num_rows($res);
                ?>
                <h1><?php echo $count;?></h1><br>
                Categories
            </div>
            <div class="col-4 center">
                <?php
                //SQL query
                $sql2 = "SELECT * FROM tbl_food";
                //Execute query
                $res2 = mysqli_query($conn,$sql2);

                //count rows
                $count2 = mysqli_num_rows($res2);
                ?>
                <h1><?php echo $count2;?></h1><br>
                Foods
            </div>
            <div class="col-4 center">
            <?php
                //SQL query
                $sql3 = "SELECT * FROM tbl_orders";
                //Execute query
                $res3 = mysqli_query($conn,$sql3);

                //count rows
                $count3 = mysqli_num_rows($res3);
                ?>
                <h1><?php echo $count3;?></h1><br>
                Total orders
            </div>
            <div class="col-4 center">
            <?php
                //SQL query
                $sql4 = "SELECT SUM(total) AS Total FROM tbl_orders WHERE status='delivered'";
                //Execute query
                $res4 = mysqli_query($conn,$sql4);

                //get values
                $row = mysqli_fetch_assoc($res4);

                //get revenue
                $revenue = $row['Total'];


                ?>
                <h1>$ <?php echo $revenue;?></h1><br>
                Revenue Generated
            </div>
            <div class="clearfix"></div>
            </div>
        </div>
        <!--Menu content section ends-->
        <!--footer section-->
        <?php include('parcels/footer.php');?>
        <!--footer ends -->
