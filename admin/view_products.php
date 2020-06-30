<?php include "admin_header.php" ?>





            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Product List
                        </h1>
                        
                    </div>
                </div>
                <!-- /.row -->
                <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                
                        <th>Id</th>
                        <th>Title</th>                       
                        <th>Image</th>
                        <th>Description</th>
                        <th>Info</th>
                        <th>Price</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                
                      <tbody>
                      <?php 
                            $query = "SELECT * FROM products";
                            $load_products_query = mysqli_query($conn,$query);

                            if (!$load_products_query) {
                                die("QUERY FAILED". mysqli_error($conn));
                            }

                            while ($row = mysqli_fetch_array($load_products_query)) {
                                $product_id = $row['id_products'];
                                $product_title = $row['title_products'];
                                $product_image = $row['image_products'];
                                $product_desc = $row['description_products'];
                                $product_info = $row['infor_products'];
                                $product_price = $row['price_products'];
                            


                                echo "<tr>";
                                echo "<td>$product_id</td>";
                                echo "<td>$product_title</td>";
                                echo "<td><img class= 'img-responsive' src='../img/$product_image' alt=''></td>";
                                echo "<td>$product_desc</td>";
                                echo "<td>$product_info</td>";
                                echo "<td>$product_price</td>";
                                echo "<td> <a href='edit_product.php?edit=$product_id'>Edit</a></td>";
                                echo "<td><a href='view_products.php?delete=$product_id'>Delete</a></td>";
                                echo "</tr>";
                            }

                            if (isset($_GET['delete'])) {
                                $deleted_product_id = $_GET['delete'];

                                $delete_query = "DELETE FROM products WHERE id_products = $deleted_product_id";
                                $deleted_product_query = mysqli_query($conn,$delete_query);

                                header('Location: view_products.php');
                            }

                        ?>

                      </tbody>
            </table>
            
            </form>

            </div>
        

    <?php include "admin_footer.php" ?>