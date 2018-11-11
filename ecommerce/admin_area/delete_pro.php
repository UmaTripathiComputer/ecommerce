<?php
if(!isset($_SESSION['user_email'])){
		echo "<script>window.open('login.php?not_admin=You are not an admin!','_self')</script>";
}else{
include("includes/db.connection.inc.php");

if(isset($_GET['delete_pro'])){
  $delete_id=$_GET['delete_pro'];
  $get_cart_del="delete from cart where p_id='$pro_id'";
  $run_cart_del=mysqli_query($GLOBALS['conn'],$get_cart_del);

  $get_del="delete from products where product_id='$pro_id'";
  $run_del=mysqli_query($GLOBALS['conn'],$get_del);
  if($run_del){

  echo "<script>alert('Product Has been DELETED successfully!')</script>";
  echo "<script>window.open('index.php?view_product','_self')</script>";

  }
}
}

?>
