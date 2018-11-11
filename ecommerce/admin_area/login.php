<html>
<head>
  <title>Administrator Login</title>
  <link rel="stylesheet" href="styles/login_style.css" media="all">
</head>
<body>

  <div class="login">
    <h2 style="color:white; text-align:center;"><?php echo @$_GET['not_admin']; ?></h2>
    <h2 style="color:white; text-align:center;"><?php echo @$_GET['logged_out'] ?></h2>
    <br>
  	<h1>Administrator Login</h1>
      <form action="" method="post">
      	<input type="text" name="email" placeholder="Email id please" required="required" />
          <input type="password" name="pass" placeholder="Password" required="required" />
          <button type="submit" name="admin_login" class="btn btn-primary btn-block btn-large">Let me in.</button>
      </form>
  </div>
</body>
</html>

<?php
include 'includes/db.connection.inc.php';
session_start();


if(isset($_POST['admin_login'])){
  $admin_email=mysqli_real_escape_string($GLOBALS['conn'],$_POST['email']);
  $admin_pass=mysqli_real_escape_string($GLOBALS['conn'],$_POST['pass']);

  $get_admin="select * from administrators where user_email='$admin_email' AND user_password='$admin_pass'";
  $run_admin=mysqli_query($GLOBALS['conn'],$get_admin);
  $row_admin=mysqli_num_rows($run_admin);
  if($row_admin==0){
    echo "<script>alert('Incorrect user id or password!')</script>";
    echo "<script>window.open('login.php?logged_in=Login unsuccessful!','_self')</script>";
  }else{
    $_SESSION['user_email']=$admin_email;
    echo "<script>window.open('index.php?logged_in=You have successfully loggedin!','_self')</script>";
  }
}

?>
