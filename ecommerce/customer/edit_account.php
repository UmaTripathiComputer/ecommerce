<?php

$user=$_SESSION['customer_email'];
$get_customer="select * from customers where customer_email='$user'";
$run_customer=mysqli_query($GLOBALS['conn'],$get_customer);
$row_customer=mysqli_fetch_array($run_customer);
$id=$row_customer['customer_id'];
$name=$row_customer['customer_name'];
$email=$row_customer['customer_email'];
$pass=$row_customer['customer_pass'];
$image=$row_customer['customer_image'];
$country=$row_customer['customer_country'];
$city=$row_customer['customer_city'];
$contact=$row_customer['customer_contact'];
$address=$row_customer['customer_address'];
?>

        <form action="" method="post" enctype="multipart/form-data">
                <table align="center" width="750">
                    <tr align="center">
                        <td colspan="3"><h2>Update account</h2></td>
                    </tr>

                    <tr>
                        <td align="right">Customer Name:</td>
                        <td align="left"><input type="text" name="c_name" value="<?php echo $name;?>" required/></td>
                    </tr>

                    <tr>
                        <td align="right">Customer Email:</td>
                        <td align="left"><input type="text" name="c_email"  value="<?php echo $email;?>" required/></td>
                    </tr>

                    <tr>
                        <td align="right">Customer password:</td>
                        <td  align="left"><input type="password" name="c_pass"  value="<?php echo $pass;?>" required/></td>
                    </tr>

                    <tr>
                        <td align="right">Customer image:</td>
                        <td  align="left">
                          <input type="file" name="c_image"/>
                          <img src="customer_images/<?php echo $image;?>" height="60"/>
                        </td>
                    </tr>

                    <tr>
                        <td align="right">Customer country:</td>
                        <td align="left" >
                          <select name="c_country" disabled>
                            <option><?php echo $country; ?></option>
                          </select>
                        </td>
                    </tr>

                    <tr>
                      <td align="right">Customer city:</td>
                      <td align="left"><input type="text" name="c_city"  value="<?php echo $city;?>" required/></td>
                    </tr>

                    <tr>
                      <td align="right">Customer contact:</td>
                      <td align="left"><input type="text" name="c_contact"  value="<?php echo $contact;?>" required/></td>
                    </tr>

                    <tr>
                      <td align="right">Customer address:</td>
                      <td align="left"><input type="text" width="150" name="c_address"  value="<?php echo $address;?>" required/></td>
                    </tr>

                    <tr align="center">
                      <td colspan="6"><input type="submit" name="update" value="Update account"/></td>
                    </tr>

                </table>
            </form>


<?php
if(isset($_POST['update'])){

  $c_id=$id;
  $c_name=$_POST['c_name'];
  $c_email=$_POST['c_email'];
  $c_password=$_POST['c_pass'];
  $c_city=$_POST['c_city'];
  $c_contact=$_POST['c_contact'];
  $c_address=$_POST['c_address'];
  $c_image=$_FILES['c_image']['name'];
  $c_image_temp=$_FILES['c_image']['tmp_name'];


  move_uploaded_file($c_image_temp,"customer_images/$c_image");
    $update_c ="update customers set customer_name='$c_name',	customer_email='$c_email',	customer_pass='$c_password', customer_contact='$c_contact',	customer_address='$c_address',	customer_image='$c_image' where customer_id='$c_id'";

  $run_update=mysqli_query($GLOBALS['conn'],$update_c);
  if($run_update){
    echo "<script>alert('Your account is updated successfully !')</script>";
    echo "<script>window.open('my_account.php','_self')</script>";
  }
}
?>
