<html>
<h2 style="text-align:center;"><br><br>Do you really want to DELETE the account ?</h2>

<form action="" method="post">
<br><br><br>
<input type="submit" name="yes" value="Yes I want"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="submit" name="no" value="No I was just joking"/>
</form>
</html>

<?php
$user=$_SESSION['customer_email'];

if(isset($_POST['yes'])){
  $delete_customer="delete from customers where customer_email='$user'";
  $run_customer=mysqli_query($GLOBALS['conn'],$delete_customer);
  echo "<script>alert('Account deleted. Hope you had a good time here!')</script>";
  echo "<script>window.open('../index.php','_self')</script>";
  session_destroy();
}

if(isset($_POST['no'])){
  echo "<script>alert('Oohhh! Do not joke again!')</script>";
  echo "<script>window.open('my_account.php','_self')</script>";
}
?>
