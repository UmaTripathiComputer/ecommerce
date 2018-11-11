<?php
if(!isset($_SESSION['user_email'])){
		echo "<script>window.open('login.php?not_admin=You are not an admin!','_self')</script>";
}else{
?>

<table width="795" align="center" bgcolor="pink">

  <tr>
      <td colspan="50" align="center"><h2>List of all products</h2></td>
  </tr>



  <tr align="center" bgcolor="skyblue">
    <th>S.N.</th>
    <th>Title</th>
    <th>Image</th>
    <th>Price</th>
    <th>Edit</th>
    <th>Delete</th>
  </tr>

<?php
include 'includes/db.connection.inc.php';
if(!isset($_SESSION['user_email'])){
		echo "<script>window.open('login.php?not_admin=You are not an admin!','_self')</script>";
}else{
$get_pro="select * from products";
$run_pro=mysqli_query($GLOBALS['conn'],$get_pro);
$i=0;
while($row_pro=mysqli_fetch_array($run_pro)){
  $pro_id=$row_pro['product_id'];
  $pro_title=$row_pro['product_title'];
  $pro_image=$row_pro['product_image'];
  $pro_price=$row_pro['product_price'];
  $i++;
?>

    <tr>
      <td><?php echo $i;?></td>
      <td align="center"><?php echo $pro_title;?></td>
      <td align="center"><img src="product_images/<?php echo $pro_image;?>" width="100" height="80"/></td>
      <td align="center"><?php echo $pro_price;?></td>
      <td align="center"><a href="index.php?edit_pro=<?php echo $pro_id; ?>">Edit</a></td>
      <td align="center"><a href="delete_pro.php?delete_pro=<?php echo $pro_id; ?>">Delete</a></td>
    </tr>

<?php
    }
}
    ?>

  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
</table>
