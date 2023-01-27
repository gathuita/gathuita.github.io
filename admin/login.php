<?php include('../config/constants.php'); ?>
<html>
    <head>
        <title>Login - Food order system</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
        <div class="login">
            
            <h1 class="center">Login</h1><br>
            <?php
            if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            } 
            if(isset($_SESSION['not-logged-message']))
            {
                echo $_SESSION['not-logged-message'];
            } 
            ?>
            <!-- login form starts here-->
            <form action="" method="POST" class="center">
                Username:<br>
                <input type="text" name="username" placeholder="Enter Username"><br><br>
                Password:<br>
                <input type="password" name="password" placeholder="Enter password"><br><br>
                <input type="submit" name="submit" value="Login" class="btn-primary"><br>
            </form>
            <!-- login form ends here-->
            <p class="center"> Created by Pius K.G</p>
        </div>
    </body>
</html>

<?php
    //check whether the submit button is clicked

    if(isset($_POST['submit']))
    {
        //process login
        //1. Get data from login
        //$username = $_POST['username'];
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $raw_password = md5($_POST['password']);
        $password = mysqli_real_escape_string($conn,$raw_password);

        //2. SQL to check whether the username and password exists or not
        $sql = "SELECT * FROM tbl_admin WHERE username ='$username' AND password = '$password'";

        //3. Execute query
        $res = mysqli_query($conn, $sql);

        //4. check whether there exist rows in the table
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            //Display session message
            $_SESSION['login'] = "<div class='success'>Login successfull</div>";
            $_SESSION['user'] = $username;//check user logged in or not
            //Redirect page
            header('location:'.SITEURL.'admin/');

        }
        else
        {
            //login fail
            //Display session message
            $_SESSION['login'] = "<div class='error center'>Login Failed Try Again</div>";
            //Redirect page
            header('location:'.SITEURL.'admin/login.php');

        }
    }
?>
