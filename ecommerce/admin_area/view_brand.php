<?php
if(!isset($_SESSION['user_email'])){
		echo "<script>window.open('login.php?not_admin=You are not an admin!','_self')</script>";
}else{
?>
<table width="795" align="center" bgcolor="pink">

  <tr>
      <td colspan="50" align="center"><h2>Brands</h2></td>
  </tr>

  <tr align="center" bgcolor="skyblue">

    <th>Id</th>
    <th>Title</th>
    <th>Edit</th>
    <th>Delete</th>
  </tr>

<?php
include 'includes/db.connection.inc.php';

$get_brand="select * from brands";
$run_brand=mysqli_query($GLOBALS['conn'],$get_brand);
$i=0;
while($row_brand=mysqli_fetch_array($run_brand)){
  $brand_id=$row_brand['brand_id'];
  $brand_title=$row_brand['brand_title'];
  $i++;
?>

    <tr>
      <td align="center"><?php echo $brand_id ?></td>
      <td align="center"><?php echo $brand_title;?></td>
      <td align="center"><a href="index.php?edit_brand=<?php echo $brand_id; ?>">Edit</a></td>
      <td align="center"><a href="delete_brand.php?delete_brand=<?php echo $brand_id; ?>">Delete</a></td>
    </tr>

<?php
    }
  }
    ?>

</table>
