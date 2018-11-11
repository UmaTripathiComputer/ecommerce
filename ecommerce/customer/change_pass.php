<h2 style="text-align:center;">Change your password</h2><br><br>
<form action="" method="post">
  <table align="center" width="700">
    <tr>
    <td style="text-align:right"><b>Enter your current password:</b></td>
    <td style="text-align:left"><input type="password" name="current_pass" required/><br></td>
    </tr>

    <tr>
    <td style="text-align:right"><b>Enter new password:</b></td>
    <td style="text-align:left"><input type="password" name="new_pass" required/><br></td>
    </tr>

    <tr>
    <td style="text-align:right"><b>Re-enter new current password:</b></td>
    <td style="text-align:left"><input type="password" name="new_pass_again" required/><br></td><br>
    </tr>

  </table>
  <br>
    <input type="submit" name="change_pass" value="Update password" style="text-align:right"/><br>
</form>

<?php
if(isset($_POST['change_pass'])){

  $user=$_SESSION['customer_email'];
  $current_pass=$_POST['current_pass'];
  $new_pass=$_POST['new_pass'];
  $new_pass_again=$_POST['new_pass_again'];

  $sel_pass="select * from customers where customer_email='$user' and customer_pass='$current_pass'";
  $run_pass=mysqli_query($GLOBALS['conn'],$sel_pass);
  $check_pass=mysqli_num_rows($run_pass);

  if($check_pass==0){
      echo "<script>alert('Your current password is wrong!')</script>";
      exit();
  }

  if($new_pass != $new_pass_again){
      echo "<script>alert('New passwords do not match!')</script>";
      exit();
  }

  if($new_pass == $current_pass){
      echo "<script>alert('New password should not be same as old. Please change!')</script>";
      exit();
  }

  else{
      $update_pass="update customers set customer_pass='$new_pass' where customer_email='$user' ";
      $run_update=mysqli_query($GLOBALS['conn'],$update_pass);
      echo "<script>alert('Password update successful!')</script>";
      echo "<script>window.open('my_account.php','_self')</script>";
  }
}
?>
