<?php
if(!isset($_SESSION['user_email'])){
		echo "<script>window.open('login.php?not_admin=You are not an admin!','_self')</script>";
}else{

include("includes/db.connection.inc.php");

if(isset($_GET['delete_brand'])){
  $delete_id=$_GET['delete_brand'];
  $get_brand_del="delete from brands where brand_id='$delete_id'";
  $run_brand_del=mysqli_query($GLOBALS['conn'],$get_brand_del);

  if($run_brand_del){
  echo "<script>alert('Brand has been DELETED successfully!')</script>";
  echo "<script>window.open('index.php?view_brand','_self')</script>";

  }
}
}
?>
