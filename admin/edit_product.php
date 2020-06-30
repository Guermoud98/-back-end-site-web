<?php include "admin_header.php" ?>
<?php 

if (isset($_GET['edit'])) {
    $pro_id = $_GET['edit']; 
}

$edit_query = "SELECT * FROM products WHERE id_products= $pro_id ";
$load_product_query = mysqli_query($conn,$edit_query);

while($row = mysqli_fetch_array($load_product_query)){
$p_id = $row['id_products'];
$p_title = $row['title_products'];
$p_image = $row['image_products'];
$p_desc = $row['description_products'];
$p_info = $row['infor_products'];
$p_price = $row['price_products'];
}

if (isset($_POST['edit_product'])) {
    $product_title = $_POST['title_products'];
    $product_image = $_FILES['image']['name'];
    $product_image_temp = $_FILES['image']['tmp_name'];
    $product_desc = $_POST['description_products'];
    $product_info = $_POST['infor_products'];
    $product_price = $_POST['price_products'];

    move_uploaded_file($product_image_temp, "../img/$product_image");

    $product_title = mysqli_real_escape_string($conn,$product_title);
    $product_image = mysqli_real_escape_string($conn,$product_image);
    $product_desc = mysqli_real_escape_string($conn,$product_desc);
    $product_info = mysqli_real_escape_string($conn,$product_info);

    $query = "UPDATE products SET title_products = '$product_title' ,image_products ='$product_image', decription_products = '$product_desc', infor_products = '$product_info', price_products = '$product_price'  WHERE id_products = $p_id ";
    $edit_product_query = mysqli_query($conn,$query);

    if (!$edit_product_query) {
        die("QUERY FAILED". mysqli_error($conn));
    }

    
}

?>




            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Edit product
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
             <form action="edit_product.php?edit=<?php echo $p_id ?>" method="post" enctype="multipart/form-data">    
     
     
                    <div class="form-group">
                        <label for="title">Product Title</label>
                        <input type="text" value = "<?php echo $p_title ?>" class="form-control" name="product_title">
                    </div>

                    <!-- <div class="form-group">
                        <select name="post_status" id="">
                            <option value="draft">Post Status</option>
                            <option value="published">Published</option>
                            <option value="draft">Draft</option>
                        </select>
                    </div> -->
      
      
      
                    <div class="form-group">
                        <label for="product_image">Product Image</label>
                        <input type="file"  name="image">
                    </div>

                    
                    <div class="form-group">
                        <label for="product_desc">Product Description</label>
                        <textarea class="form-control" name="product_desc" id="" cols="30" rows="5"><?php echo $p_desc ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="product_info">Product Infos</label>
                        <textarea class="form-control" name="product_info" id="" cols="30" rows="5"><?php echo $p_info ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="product_price">Product Price</label>
                        <input type="number" value = "<?php echo $p_price ?>" class="form-control" name="product_price">
                    </div>
                    
                    

                    <div class="form-group">
                        <input class="btn btn-primary" type="submit" name="edit_product" value="Edit product">
                    </div>


            </form>


            </div>
            <!-- /.container-fluid -->

        

    <?php include "admin_footer.php" ?>