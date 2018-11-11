<?php
if(!isset($_SESSION['user_email'])){
		echo "<script>window.open('login.php?not_admin=You are not an admin!','_self')</script>";
}else{
?>


<table width="795" align="center" bgcolor="pink">

  <tr>
      <td colspan="50" align="center"><h2>Categories</h2></td>
  </tr>

  <tr align="center" bgcolor="skyblue">

    <th>Id</th>
    <th>Title</th>
    <th>Edit</th>
    <th>Delete</th>
  </tr>

<?php
include 'includes/db.connection.inc.php';
if(!isset($_SESSION['user_email'])){
		echo "<script>window.open('login.php?not_admin=You are not an admin!','_self')</script>";
}else{
$get_cat="select * from categories";
$run_cat=mysqli_query($GLOBALS['conn'],$get_cat);
$i=0;
while($row_cat=mysqli_fetch_array($run_cat)){
  $cat_id=$row_cat['cat_id'];
  $cat_title=$row_cat['cat_title'];
  $i++;
?>

    <tr>
      <td align="center"><?php echo $cat_id ?></td>
      <td align="center"><?php echo $cat_title;?></td>
      <td align="center"><a href="index.php?edit_cat=<?php echo $cat_id; ?>">Edit</a></td>
      <td align="center"><a href="delete_cat.php?delete_cat=<?php echo $cat_id; ?>">Delete</a></td>
    </tr>

<?php
    }
  }
    ?>

</table>
