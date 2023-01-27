<?php
//start session
session_start();
//create constants
define('SITEURL','http://localhost/Food-order/');
define('LOCALHOST','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','food_order');

$conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysql_error());//database connection
$db_select = mysqli_select_db($conn, DB_NAME) or die(mysql_error());//selectin db
?>