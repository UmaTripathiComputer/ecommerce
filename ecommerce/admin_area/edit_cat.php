<?php
if(!isset($_SESSION['user_email'])){
		echo "<script>window.open('login.php?not_admin=You are not an admin!','_self')</script>";
}else{
include("includes/db.connection.inc.php");

  $categry_id=$_GET['edit_cat'];
  $get_id="select * from categories where cat_id='$categry_id'";
  $run_cat=mysqli_query($GLOBALS['conn'], $get_id);
  $row_cat=mysqli_fetch_array($run_cat);
  $cat_id=$row_cat['cat_id'];
  $cat_title=$row_cat['cat_title'];
?>

<form action="" method="post" style="padding:80px;">
<b>Update category:</b>
<!-- <input type="text" name="updated_cat_id" value="<?php //echo $cat_id ?>" required/>&nbsp; &nbsp; &nbsp; &nbsp; -->
<input type="text" name="updated_cat_title" value="<?php echo $cat_title ?>" required/>&nbsp; &nbsp; &nbsp; &nbsp;
<input type="submit" name="cat_update" value="Update category"/>

</form>

<?php

  if(isset($_POST['cat_update'])){
    $updated_cat_id=$cat_id;
    //$new_cat=$_POST['new_cat'];
    //$updated_cat_id=$_POST['updated_cat_id'];
    $updated_cat_title=$_POST['updated_cat_title'];
    $update_cat="update categories set cat_title='$updated_cat_title' where cat_id='$updated_cat_id'";
    $run_cat=mysqli_query($GLOBALS['conn'],$update_cat);

    if($run_cat){
        echo "<script>alert('Category updated!')</script>";
        echo "<script>window.open('index.php?view_cat','_self')</script>";
    }
}
}
?>
