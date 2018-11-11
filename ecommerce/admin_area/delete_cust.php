<?php
if(!isset($_SESSION['user_email'])){
		echo "<script>window.open('login.php?not_admin=You are not an admin!','_self')</script>";
}else{
include("includes/db.connection.inc.php");

if(isset($_GET['delete_cust'])){
  $delete_id=$_GET['delete_cust'];
  $get_cust_del="delete from customers where customer_id='$delete_id'";
  $run_cust_del=mysqli_query($GLOBALS['conn'],$get_cust_del);
  if($run_cust_del){
  echo "<script>alert('Customer Has been DELETED successfully!')</script>";
  echo "<script>window.open('index.php?view_customers','_self')</script>";
  }
}
}
?>
