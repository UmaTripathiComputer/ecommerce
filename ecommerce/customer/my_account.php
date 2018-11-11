<!DOCTYPE html>
<?php
session_start();
include 'includes/db.connection.inc.php';
include 'functions/function.php';
?>

<html>
<head>
  <title>My Online shop</title>

  <link rel="stylesheet" href="styles/style.css" media:"all"/>
</head>
<body>
  <!-- Main wrapper starts here-->
  <div class="main_wrapper">

      <!--Header starts here-->
      <div class="header_wrapper">

          <img id='logo' src="images/image1.jpeg">
          <img id='banner' src="images/image2.jpeg">

      </div>
      <!--Header ends here-->

      <!--Menu starts here-->
      <div class="menubar">
          <ul id="menu">
              <li><a href="../index.php ">HOME</a></li>
              <li><a href="../all_products.php">ALL PRODUCTS</a></li>
              <li><a href="my_account.php">MY ACCOUNT</a></li>
              <li><a href="customer_login.php">SIGN UP</a></li>
              <li><a href="../cart.php">SHOPPING CART</a></li>
              <li><a href="#">CONTACT US</a></li>
          </ul>
          <div id="form"></div>
              <form method="post" action="results.php" enctype="multipart/form-data">
                  <input type="text" name="user_query" placeholder="Search a product" />
                  <input type="submit" name="search" value="Search" />
              </form>

      </div>
      <!--Menu ends here-->

      <!--content starts here -->
      <div class="content_wrapper">
          <div id="sidebar">

              <div id="sidebar_title">My Account</div>
                  <ul id="cats">
                    <?php
                      //displaying logged in users account with her/his picture
                      $user=$_SESSION['customer_email'];
                      $get_img="select * from customers where customer_email='$user'";
                      $run_img=mysqli_query($GLOBALS['conn'],$get_img);
                      $row_img=mysqli_fetch_array($run_img);
                      $c_image=$row_img['customer_image'];
                      $c_name=$row_img['customer_name'];
                      echo "<p><img src='customer_images/$c_image' height='150' width='150' style='text-align:center; border:2px solid white; padding:5px' /></p>";
                    ?>
                    <li><a href="my_account.php?my_orders">My orders</a></li>
                    <li><a href="my_account.php?edit_account">Edit account</a></li>
                      <li><a href="my_account.php?change_pass">Change Password</a></li>
                    <li><a href="my_account.php?delete_account">Delete account</a></li>
                  </ul>

              <!-- <div id="sidebar_title">Brands</div>
                  <ul id="cats">
                      <?php //getBrands();?>
                  </ul> -->

          </div>

          <div id="content_area">
            <?PHP cart(); ?>
              <div id="shopping_cart">
                  <span style="float:right; font-size:18px; padding:5px; color:white; line-height:40px;">
                    <?php
                      if(isset($_SESSION['customer_email'])){
                        echo "<b>Welcome ".$_SESSION['customer_email']."! ";
                      }else{
                        echo "<b>Welcome Guest! </b>";
                      }
                    ?>
                      <b style="color:yellow; ">Cart - </b>Total Items: <?php total_items();?>   ||   Total price: <span>&#8377;</span> <?php total_price();?>
                      <a href="../cart.php" style="color:yellow">Go to cart</a>

                      <?php
                      if(!isset($_SESSION['customer_email'])){
                        echo "<a href='../checkout.php' style='color:white'>Login</a>";
                      }else{
                        echo "<a href='../logout.php' style='color:white'>Logout</a>";
                      }
                      ?>
                  </span>
              </div>

              <?php getIp();?>
              <div id="products_box">


                <?php
                if(!isset($_GET['my_orders'])){
                  if(!isset($_GET['edit_account'])){
                    if(!isset($_GET['change_pass'])){
                      if(!isset($_GET['delete_account'])){
                          echo "<b><h2 style='padding:20px;'>Welcome: $c_name </h2></br>You can see your orders by clicking this <a href='my_account.php?my_orders' style='text-decoration:none;'>link</a>.</b>";
                      }else{ include 'delete_account.php'; }
                    }else{ include 'change_pass.php'; }
                  }else{ include 'edit_account.php'; }
                }

               ?>


              </div>
          </div>
      </div>
      <!--content ends here -->

      <div id="footer">
          <h2 style="text-align:center; padding-top:40px;">&copy; 2018 Made by Uma</h2>
      </div>

  </div>
  <!-- Main wrapper ends here-->

</body>
</html>
