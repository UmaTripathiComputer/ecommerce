<!DOCTYPE>

<?php
if(!isset($_SESSION['user_email'])){
		echo "<script>window.open('login.php?not_admin=You are not an admin!','_self')</script>";
}else{
include("includes/db.connection.inc.php");


$p_id=$_GET['edit_pro'];
$get_pro="select * from products where product_id='$p_id'";
$run_pro=mysqli_query($GLOBALS['conn'],$get_pro);
$i=0;
  $row_pro=mysqli_fetch_array($run_pro);
  $pro_id=$row_pro['product_id'];

  $pro_cat_no=$row_pro['product_cat'];
  $get_cat_no="select * from categories where cat_id='$pro_cat_no'";
  $run_get_cat_no=mysqli_query($GLOBALS['conn'],$get_cat_no);
  $pro_cat_fetch=mysqli_fetch_array($run_get_cat_no);
  $cat_id=$pro_cat_fetch['cat_id'];
  $pro_cat=$pro_cat_fetch['cat_title'];

  $pro_brand_no=$row_pro['product_brand'];
  $get_brand_no="select * from brands where brand_id='$pro_brand_no'";
  $run_get_brand_no=mysqli_query($GLOBALS['conn'],$get_brand_no);
  $pro_brand_fetch=mysqli_fetch_array($run_get_brand_no);
  $brand_id=$pro_brand_fetch['brand_id'];
  $pro_brand=$pro_brand_fetch['brand_title'];

  $pro_title=$row_pro['product_title'];
  $pro_image=$row_pro['product_image'];
  $pro_price=$row_pro['product_price'];
  $pro_desc=$row_pro['product_desc'];
  $pro_keywords=$row_pro['product_keyword'];
  $i++;
?>

<html>
	<head>
		<title>Inserting Product</title>

<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
<script>
        tinymce.init({selector:'textarea'});
</script>
	</head>

<body bgcolor="skyblue">


	<form action="" method="post" enctype="multipart/form-data">

		<table align="center" width="800" border="2" bgcolor="orange">

			<tr align="center">
				<td colspan="2"><h2>Update products</h2></td>
			</tr>

			<tr>
				<td align="right"><b>Product Title:</b></td>
				<td><input type="text" name="product_title" value="<?php echo $pro_title;  ?>" size="60" required/></td>
			</tr>

			<tr>
				<td align="right"><b>Product Category:</b></td>
				<td>
				<select name="product_cat" required>
					<option value="<?php echo $cat_id; ?>"><?php echo $pro_cat; ?></option>
					<?php
		          $get_cats = "select * from categories";
		          $run_cats = mysqli_query($conn, $get_cats);

		            while ($row_cats=mysqli_fetch_array($run_cats)){
		                $cat_id = $row_cats[0];
		                $cat_title = $row_cats[1];
		                echo "<option value='$cat_id'>$cat_title</option>";
	              }
					?>
				</select>
				</td>
			</tr>

			<tr>
				<td align="right"><b>Product Brand:</b></td>
				<td>
				<select name="product_brand" required>
					<option value=<?php echo $brand_id; ?>><?php echo $pro_brand; ?></option>
					<?php
		          $get_brands = "select * from brands";
	            $run_brands = mysqli_query($conn, $get_brands);

	               while ($row_brands=mysqli_fetch_array($run_brands)){
		                 $brand_id = $row_brands['brand_id'];
		                 $brand_title = $row_brands['brand_title'];
	                   echo "<option value='$brand_id'>$brand_title</option>";
	               }
				  ?>
				</select>
				</td>
			</tr>

			<tr>
				<td align="right"><b>Product Image:</b></td>
				<td ><input type="file" name="product_image"/>
              <img src="product_images/<?php echo $pro_image; ?>"   width="100" height="80"/></td>
			</tr>

			<tr>
				<td align="right"><b>Product Price:</b></td>
				<td><input type="text" name="product_price" value= <?php echo $pro_price; ?> required/></td>
			</tr>

			<tr>
        <td align="right"><b>Description:</b></td>
        <td><textarea name="product_desc" cols="10" rows="5"><?php echo $pro_desc; ?></textarea></td>

			</tr>

			<tr>
				<td align="right"><b>Product Keywords:</b></td>
				<td><input type="text" name="product_keywords" size="50" value="<?php echo $pro_keywords; ?>" required/></td>
			</tr>

			<tr align="center">
				<td colspan="2"><input type="submit" name="update_post" value="Update Product"/></td>
			</tr>

		</table>


	</form>


</body>
</html>
<?php

	if(isset($_POST['update_post'])){

		//getting the text data from the fields
		$product_title = $_POST['product_title'];
		$product_cat= $_POST['product_cat'];
		$product_brand = $_POST['product_brand'];
		$product_price = $_POST['product_price'];
		$product_desc = $_POST['product_desc'];
		$product_keywords = $_POST['product_keywords'];

		//getting the image from the field
		$product_image = $_FILES['product_image']['name'];
		$product_image_tmp = $_FILES['product_image']['tmp_name'];

		move_uploaded_file($product_image_tmp,"product_images/$product_image");

		 $update_product = "update products set product_cat='$product_cat', product_brand='$product_brand', product_title='$product_title', product_price='$product_price', product_desc='$product_desc', product_image='$product_image', product_keyword='$product_keywords' where product_id='$p_id'";

		 $update_pro = mysqli_query($GLOBALS['conn'], $update_product);

		 if($update_pro){

		 echo "<script>alert('Product Has been updated!')</script>";
		 echo "<script>window.open('index.php?view_product','_self')</script>";

		 }
	}
}
?>
