<?php
if(!isset($_SESSION['user_email'])){
		echo "<script>window.open('login.php?not_admin=You are not an admin!','_self')</script>";
}else{
include("includes/db.connection.inc.php");

if(isset($_GET['delete_cat'])){
  $delete_id=$_GET['delete_cat'];
  $get_cat_del="delete from categories where cat_id='$delete_id'";
  $run_cat_del=mysqli_query($GLOBALS['conn'],$get_cat_del);

  if($run_cat_del){
  echo "<script>alert('Category has been DELETED successfully!')</script>";
  echo "<script>window.open('index.php?view_cats','_self')</script>";

  }
}
}
?>
