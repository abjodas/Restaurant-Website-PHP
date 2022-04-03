<?php include('partials/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <?php  
                $id = $_GET['id'];
                $sql = "SELECT * FROM tbl_food WHERE id=$id";
                $res = mysqli_query($conn,$sql);
                $rows = mysqli_fetch_assoc($res);
                if($id=="")
                {
                    header('location:'.SITE_URL.'index.php');
                    die();
                }
            ?>
            <form action="#" class="order" method="POST">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <img src="<?php echo SITE_URL; ?>images/food/<?php echo $rows['image_name']; ?>"  class="img-responsive img-curve">
                    </div>
                    <input type="hidden" name="food" value="<?php echo $rows['title']; ?>">
                    <input type="hidden" name="price" value="<?php echo $rows['price']; ?>">
                    <div class="food-menu-desc">
                        <h3><?php echo $rows['title']; ?></h3>
                        <p class="food-price"><?php echo $rows['price']; ?></p>

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. John Doe" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. johndoe@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>
                <?php 
                    //CHeck whether the submit button is clicked or not
                    if(isset($_POST['submit']))
                    {
                        date_default_timezone_set('UTC');
                        $food = $_POST['food'];
                        $price = $_POST['price'];
                        $qty = $_POST['qty'];
                        $customer_name = $_POST['full-name'];
                        $customer_contact = $_POST['contact'];
                        $customer_email = $_POST['email'];
                        $customer_address = $_POST['address'];
                        $order_date = date('Y-m-d h:i:s');
                        $total = $price * $qty;
                        $status = "Not Delivered";
                        
                        $sql = "INSERT INTO tbl_order SET
                        food = '$food',
                        price = $price,
                        qty = $qty,
                        total = $total,
                        order_date = '$order_date',
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address'
                        ";
                        $res = mysqli_query($conn,$sql);
                        if($res == TRUE)
                        {
                            $_SESSION['order'] = "<div class='success google-font text-center'>Order Placed Successfully</div>";
                            header('location:'.SITE_URL.'index.php');
                        }
                        else{
                            $_SESSION['order'] = "<div class='failure google-font text-center'>Order Failed</div>";
                            header('location:'.SITE_URL.'index.php');
                        }
                    }
                ?>
        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <!-- social Section Starts Here -->
    <section class="social">
        <div class="container text-center">
            <ul>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/50/000000/facebook-new.png"/></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/48/000000/instagram-new.png"/></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/48/000000/twitter.png"/></a>
                </li>
            </ul>
        </div>
    </section>


    <?php include('partials/footer.php'); ?>