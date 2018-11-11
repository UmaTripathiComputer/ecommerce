<?php
if(!isset($_SESSION['user_email'])){
		echo "<script>window.open('login.php?not_admin=You are not an admin!','_self')</script>";
}else{
include("includes/db.connection.inc.php");

  $brand_url_id=$_GET['edit_brand'];
  $get_id="select * from brands where brand_id='$brand_url_id'";
  $run_brand=mysqli_query($GLOBALS['conn'], $get_id);
  $row_brand=mysqli_fetch_array($run_brand);
  $brand_id=$row_brand['brand_id'];
  $brand_title=$row_brand['brand_title'];
?>

<form action="" method="post" style="padding:80px;">
<b>Update category:</b>
<input type="text" name="updated_brand_title" value="<?php echo $brand_title ?>" required/>&nbsp; &nbsp; &nbsp; &nbsp;
<input type="submit" name="brand_update" value="Update category"/>

</form>

<?php

  if(isset($_POST['brand_update'])){
    $updated_brand_id=$brand_id;
    $updated_brand_title=$_POST['updated_brand_title'];
    $update_brand="update brands set brand_title='$updated_brand_title' where brand_id='$updated_brand_id'";
    $run_brand=mysqli_query($GLOBALS['conn'],$update_brand);

    if($run_brand){
        echo "<script>alert('Brand updated!')</script>";
        echo "<script>window.open('index.php?view_brand','_self')</script>";
    }
}
}
?>
