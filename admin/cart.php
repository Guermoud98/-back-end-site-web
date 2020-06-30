<?php include "admin_header.php" ?>
<?php session_start(); ?>

<?php 
    //getting the session id
    if (isset($_SESSION['id'])) {
        $client_id = $_SESSION['id_client'];
    }
    //getting the item id
    if (isset($_GET['item'])) {
        $item_id = $_GET['id_products'];
        //getting all items from cart table
    $cart_query = "SELECT * FROM carte WHERE id_cart = $item_id AND id_client = $client_id";
    $cart_search_query = mysqli_query($conn,$cart_query);
    if (!$cart_search_query) {
        die("QUERY FAILED" . mysqli_error($conn));
    }
    while ($row = mysqli_fetch_array($cart_search_query)) {
        $item_title = $row['title_cart'];
        $item_image = $row['image_cart'];
        $item_price = $row['price_cart'];
        $item_quantity = $row['quantite_cart'];
    }
    $row_count = mysqli_num_rows($cart_search_query);

    if($row_count > 0){
        $update_query = "UPDATE carte SET quantite_cart = quantite_cart+1 WHERE id_cart = $item_id AND id_client = $client_id";
        $update_item_query = mysqli_query($conn,$update_query);
        header('Location: cart.php');

    }else{
         //getting the item infos from products table
        $item_query = "SELECT * FROM products WHERE id_products = $item_id";
        $item_search_query = mysqli_query($conn,$item_query);

        while ($row = mysqli_fetch_array($item_search_query)) {
            $item_title = $row['title_products'];
            $item_image = $row['image_products'];
            $item_price = $row['price_products'];
            
        }

        if (!$item_search_query) {
            die("QUERY FAILED" . mysqli_error($conn));
        }

         //adding the item to cart if it doesn't already exist
        $add_query = "INSERT INTO carte(id_client,id_cart,title_cart,image_cart,price_cart) VALUES ($client_id,$item_id,'$item_title','$item_image',$item_price)";
        $add_to_cart_query = mysqli_query($conn,$add_query);

        if (!$add_to_cart_query) {
            die("QUERY FAILED" . mysqli_error($conn));
        }

        header('Location: cart.php');
    }
    }

    

   

      

?>



            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Cart
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
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Add</th>
                        <th>Reduce</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                
                      <tbody>
                      <?php 
                            
                            $cart_query = "SELECT * FROM carte WHERE id_client = $client_id";
                            $cart_search_query = mysqli_query($conn,$cart_query);
                            while ($row = mysqli_fetch_array($cart_search_query)) {
                                
                                $cart_id = $row['id_cart'];
                                $item_title = $row['title_cart'];
                                $item_image = $row['image_cart'];
                                $item_price = $row['price_cart'];
                                $item_quantity = $row['quantite_cart'];
                                $total = $item_price * $item_quantity;

                                echo "<tr>";
                                echo "<td>$cart_id</td>";
                                echo "<td>$item_title</td>";
                                echo "<td><img class= 'img-responsive' src='../img/$item_image' alt=''></td>";
                                echo "<td>$item_price</td>";
                                echo "<td>$item_quantity</td>";
                                echo "<td>$total</td>";
                                echo "<td><a href='cart.php?add=$cart_id&user=$client_id'>Add</a></td>";
                                echo "<td><a href='cart.php?reduce=$cart_id&user=$client_id'>Reduce</a></td>";
                                echo "<td><a href='cart.php?remove=$cart_id&user=$client_id'>Remove</a></td>";
                                echo "</tr>";

                            }

                                
                            if (isset($_GET['remove'])) {
                                $removed_item_id = $_GET['remove'];

                                $remove_query = "DELETE FROM carte WHERE id_cart = $removed_item_id AND id_client = $client_id";
                                $removed_item_query = mysqli_query($conn,$remove_query);

                                header('Location: cart.php');
                            }
                            if (isset($_GET['add'])) {
                                $added_item_id = $_GET['add'];

                                $add_item_query = "UPDATE carte SET quantite_cart = quantite_cart + 1 WHERE id_cart = $added_item_id AND id_cart = $client_id";
                                $added_item_query = mysqli_query($conn,$add_item_query);

                                header('Location: cart.php');
                            }

                            if (isset($_GET['reduce'])) {
                                $reduced_item_id = $_GET['reduce'];

                                $check_query = "SELECT * FROM carte WHERE id_cart = $reduced_item_id AND id_client = $client_id ";
                                $check_quantity_query = mysqli_query($conn,$check_query);
                                $check_row = mysqli_fetch_array($check_quantity_query);
                                $quantity = $check_row['quantite_cart'];

                                if ($quantity == 1 ) {
                                    $reduce_item_query = "DELETE FROM carte WHERE id_cart = $reduced_item_id AND id_client = $client_id";
                                    $reduced_item_query = mysqli_query($conn,$reduce_item_query);
                                }else{
                                    $reduce_item_query = "UPDATE carte SET quantite_cart = quantite_cart - 1 WHERE id_cart = $reduced_item_id AND id_client = $client_id";
                                    $reduced_item_query = mysqli_query($conn,$reduce_item_query);
                                }

                                

                                header('Location: cart.php');
                            }
                            

                            
                        ?>

                      </tbody>
            </table>
            <a href = "../blog.php" class="btn btn-success btn-lg" data-dismiss="modal">Back to store</a>
            <a href = "#" class="btn btn-success btn-lg" data-dismiss="modal">Proceed to checkout</a>
            
            </form>

            </div>
            <!-- /.container-fluid -->

        

    <?php include "admin_footer.php" ?>