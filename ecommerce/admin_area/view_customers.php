<?php
if(!isset($_SESSION['user_email'])){
		echo "<script>window.open('login.php?not_admin=You are not an admin!','_self')</script>";
}else{
?>

<table width="795" align="center" bgcolor="pink">

  <tr>
      <td colspan="50" align="center"><h2>List of all customers</h2></td>
  </tr>



  <tr align="center" bgcolor="skyblue">
    <th>Cust Id</th>
    <th>Name</th>
    <th>Email</th>
    <th>Country</th>
    <th>City</th>
    <th>Image</th>
    <th>Delete</th>
  </tr>

<?php
include 'includes/db.connection.inc.php';
if(!isset($_SESSION['user_email'])){
		echo "<script>window.open('login.php?not_admin=You are not an admin!','_self')</script>";
}else{
$get_cust="select * from customers";
$run_cust=mysqli_query($GLOBALS['conn'],$get_cust);
$i=0;
while($row_cust=mysqli_fetch_array($run_cust)){
  $cust_id=$row_cust['customer_id'];
  $cust_name=$row_cust['customer_name'];
  $cust_email=$row_cust['customer_email'];
  $cust_country=$row_cust['customer_country'];
  $cust_city=$row_cust['customer_city'];
  $cust_contact=$row_cust['customer_contact'];
  $cust_image=$row_cust['customer_image'];
  $i++;
?>

    <tr>
      <td><?php echo $cust_id;?></td>
      <td align="center"><?php echo $cust_name;?></td>
      <td align="center"><?php echo $cust_email;?></td>
      <td align="center"><?php echo $cust_country;?></td>
      <td align="center"><?php echo $cust_city;?></td>
      <td align="center"><img src="../customer/customer_images/<?php echo $cust_image;?>" width="100" height="80"/></td>
      <td align="center"><a href="delete_cust.php?delete_cust=<?php echo $cust_id; ?>">Delete</a></td>
    </tr>

<?php
    }
}
    ?>

</table>
