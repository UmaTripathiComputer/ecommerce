<?php
//include '../admin_area/includes/db.connection.inc.php';
//$root_name=$_SERVER['DOCUMENT_ROOT'];
//include_once '$root_name/ecommerce/admin_area/includes/db.connection.inc.php';
$conn=mysqli_connect("localhost","root","","ecommerce");
if(mysqli_connect_errno()){
  echo "Could not connect to my SQL:".mysqli_connect_errno();
}

//getting the user ip address
function getIp() {
    $ip = $_SERVER['REMOTE_ADDR'];
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    return $ip;
}

//creating the shopping cart
function cart(){
  if(isset($_GET['add_cart'])){
        $ip=getIp();
        $pro_id=$_GET['add_cart'];
        $check_pro="select * from cart where ip_add='$ip' AND p_id='$pro_id'";
        $run_check=mysqli_query($GLOBALS['conn'], $check_pro);
        if(mysqli_num_rows($run_check)>0){
            //echo "<h2>Product already present in cart.</h2>";
            echo "<script>alert('Product already in your cart!')</script>";
       		   echo "<script>window.open('index.php','_self')</script>";
        }else{
                $insert_pro="INSERT INTO cart (p_id, ip_add, qty) VALUES ('$pro_id', '$ip', 1)";
                $run_pro=mysqli_query($GLOBALS['conn'],$insert_pro);
                echo "<script>window.open('index.php','_self')</script>";
              }
    }
}

//getting total added items
function total_items(){
    if(isset($_GET['add_cart'])){
        $ip=getIp();
        $get_items="select * from cart where ip_add='$ip'";
        $run_items=mysqli_query($GLOBALS['conn'],$get_items);
        $count_items=mysqli_num_rows($run_items);

    }else{
      $ip=getIp();
      $get_items="select * from cart where ip_add='$ip'";
      $run_items=mysqli_query($GLOBALS['conn'],$get_items);
      $count_items=mysqli_num_rows($run_items);
    }
    echo $count_items;
}

//getting total price of the items present in cart
function total_price(){
  $total = 0;
  $ip = getIp();

  $sel_price = "select * from cart where ip_add='$ip'";
  $run_price = mysqli_query($GLOBALS['conn'], $sel_price);
  while($p_price=mysqli_fetch_array($run_price)){
    $pro_id = $p_price['p_id'];
    $pro_price = "select * from products where product_id='$pro_id'";
    $run_pro_price = mysqli_query($GLOBALS['conn'],$pro_price);
    while ($pp_price = mysqli_fetch_array($run_pro_price)){
      $product_price = array($pp_price['product_price']);
      $values = array_sum($product_price);
      $total +=$values;
    }
  }
  echo $total;
}


function getCategories(){
  $get_cats=mysqli_query($GLOBALS['conn'],"select * from categories;");
  while($row_cats=mysqli_fetch_array($get_cats)){
      $cat_id=$row_cats['cat_id'];
      $cat_title=$row_cats['cat_title'];
      echo "<li><a href='index.php?cat=$cat_id'>$cat_title</a></li>";
    }
}

function getBrands(){
  $get_brands=mysqli_query($GLOBALS['conn'],"select * from brands;");
  while($row_brands=mysqli_fetch_array($get_brands)){
      $brand_id=$row_brands['brand_id'];
      $brand_title=$row_brands['brand_title'];
      echo "<li><a href='index.php?brand=$brand_id'>$brand_title</a></li>";
    }
}

function getPro(){
  if(!isset($_GET['cat'])){
    if(!isset($_GET['brand'])){
      $run_pro=mysqli_query($GLOBALS['conn'],"select * from products ORDER BY RAND() LIMIT 0,6 ");

      while($row_pro=mysqli_fetch_array($run_pro)){
        $pro_id=$row_pro['product_id'];
        $pro_title=$row_pro['product_title'];
        $pro_images=$row_pro['product_image'];
        $pro_price=$row_pro['product_price'];

        echo "
        <div id='single_product'>
            <h3>$pro_title</h3>
            <img src='admin_area/product_images/$pro_images' width='180' height='180'/>
            <p><b>Price: <span>&#8377;</span> $pro_price</b></p>
            <a href='details.php?pro_id=$pro_id' style='float:left'>Details</a>
            <a href='index.php?add_cart=$pro_id'><button style='float:right'>Add to cart</button></a>
        </div>
        ";
        }
    }
  }
}

function getCatPro(){
  if(isset($_GET['cat'])){
    $cat_id=$_GET['cat'];
    $get_cat_pro="select * from products where product_cat='$cat_id'";
    $run_cat_pro=mysqli_query($GLOBALS['conn'],$get_cat_pro);
    $count_cats=mysqli_num_rows($run_cat_pro);
    if($count_cats==0){
      echo "<h2 style='padding:20px;'>No products were found in this category</h2>";
    }

      while($row_cat_pro=mysqli_fetch_array($run_cat_pro)){
        $pro_id=$row_cat_pro['product_id'];
        $pro_title=$row_cat_pro['product_title'];
        $pro_images=$row_cat_pro['product_image'];
        $pro_price=$row_cat_pro['product_price'];

        echo "
        <div id='single_product'>
            <h3>$pro_title</h3>
            <img src='admin_area/product_images/$pro_images' width='180' height='180'/>
            <p><b>$ $pro_price</b></p>
            <a href='details.php?pro_id=$pro_id' style='float:left'>Details</a>
            <a href='insert.php?pro_id=$pro_id'><button style='float:right'>Add to cart</button></a>
        </div>
        ";
      }
  }
}

function getBrandPro(){
  if(isset($_GET['brand'])){
    $brand_id=$_GET['brand'];
    $get_brand_pro="select * from products where product_brand='$brand_id'";
    $run_brand_pro=mysqli_query($GLOBALS['conn'],$get_brand_pro);
    $count_brands=mysqli_num_rows($run_brand_pro);
    if($count_brands==0){echo "<h2 style='padding:20px;'>No products were found in this category</h2>";}
    //if(!isset($_GET['brand'])){
      while($row_brand_pro=mysqli_fetch_array($run_brand_pro)){
        $pro_id=$row_brand_pro['product_id'];
        $pro_title=$row_brand_pro['product_title'];
        $pro_images=$row_brand_pro['product_image'];
        $pro_price=$row_brand_pro['product_price'];

        echo "
        <div id='single_product'>
            <h3>$pro_title</h3>
            <img src='admin_area/product_images/$pro_images' width='180' height='180'/>
            <p><b>$ $pro_price</b></p>
            <a href='details.php?pro_id=$pro_id' style='float:left'>Details</a>
            <a href='insert.php?pro_id=$pro_id'><button style='float:right'>Add to cart</button></a>
        </div>
        ";
        }
    //}
  }
}
