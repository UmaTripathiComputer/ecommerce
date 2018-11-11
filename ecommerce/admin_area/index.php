<?php
if(!isset($_SESSION['user_email'])){
    echo "<script>window.open('login.php?not_admin=You are not an admin!','_self')</script>";
}else{

session_start();
  $admin_email=$_SESSION['user_email'];

?>

<html>

<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="styles/style.css" media="all"/>
</head>

<body>
  <div class="main_wrapper">

    <div id="header"></div>
    <div id="right">
      <h2 style="text-align:center;">Manage content:</h2>
          <a href="index.php?insert_product">Insert new product</a>
          <a href="index.php?view_product">View all products</a>
          <a href="index.php?insert_cat">Insert new category</a>
          <a href="index.php?view_cat">View all categories</a>
          <a href="index.php?insert_brand">Insert new brand</a>
          <a href="index.php?view_brand">View all brands</a>
          <a href="index.php?view_customers">View customers</a>
          <a href="index.php?view_orders">View orders</a>
          <a href="index.php?view_payments">View Payments</a>
          <a href="logout.php">Admin logout</a>
    </div>
    <div id="left"><br><br>

      <h2 align="center">Welcome    <?php  echo $admin_email;?></h2>
        <?php
            if(isset($_GET['insert_product'])){
                include 'insert_product.php';
              }
            if(isset($_GET['view_product'])){
                include 'view_products.php';
            }
            if(isset($_GET['edit_pro'])){
                include 'edit_product.php';
            }
            if(isset($_GET['delete_pro'])){
                include 'delete_pro.php';
            }
            if(isset($_GET['insert_cat'])){
                include 'insert_cat.php';
            }
            if(isset($_GET['view_cat'])){
                include 'view_cat.php';
            }
            if(isset($_GET['edit_cat'])){
                include 'edit_cat.php';
            }
            if(isset($_GET['insert_brand'])){
                include 'insert_brand.php';
            }
            if(isset($_GET['view_brand'])){
                include 'view_brand.php';
            }
            if(isset($_GET['edit_brand'])){
                include 'edit_brand.php';
            }
            if(isset($_GET['delete_brand'])){
                include 'delete_brand.php';
            }
            if(isset($_GET['view_customers'])){
                include 'view_customers.php';
            }
            if(isset($_GET['delete_cust'])){
                include 'delete_customer.php';
            }
}
        ?>
    </div>
  </div>
</body>
</html>
