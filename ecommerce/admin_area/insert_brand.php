<?php
if(!isset($_SESSION['user_email'])){
		echo "<script>window.open('login.php?not_admin=You are not an admin!','_self')</script>";
}else{
?>
<form action="" method="post" style="padding:80px;">
<b>Insert new Brand:</b>
<input type="text" name="new_brand" required/>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
<input type="submit" name="add_brand" value="Add category"/>

</form>

<?php
include("includes/db.connection.inc.php");

  if(isset($_POST['add_brand'])){
    $new_brand=$_POST['new_brand'];

    $insert_brand="insert into brands (brand_title) values ('$new_brand')";
    $run_brand=mysqli_query($GLOBALS['conn'],$insert_brand);

    if($run_brand){
        echo "<script>alert('New brand inserted!')</script>";
        echo "<script>window.open('index.php?view_brand','_self')</script>";
    }
}
}
?>
