<?php include('partials/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <?php 
                $id = $_GET['id'];
                $sql = "SELECT * FROM tbl_category WHERE id=$id";
                $res = mysqli_query($conn,$sql);
                $rows = mysqli_fetch_assoc($res);
            ?>
            <h2>Foods on <a href="#" class="text-white">"<?php echo $rows['title'];?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
                $sql2 = "SELECT * FROM tbl_food WHERE category_id=$id";
                $res2 = mysqli_query($conn,$sql2);
                while($rows2 = mysqli_fetch_assoc($res2))
                {
                    $id = $rows2['id'];
                    ?>
            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="<?php echo SITE_URL ?>images/food/<?php echo $rows2['image_name']; ?>"class="img-responsive img-curve">
                </div>

                <div class="food-menu-desc">
                    <h4><?php echo $rows2['title']; ?></h4>
                    <p class="food-price"><?php echo $rows2['price']; ?></p>
                    <p class="food-detail">
                    <?php echo $rows2['description']; ?>
                    </p>
                    <br>

                    <a href="<?php echo SITE_URL; ?>order.php?id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                </div>
            </div>
                    <?php
                }
            ?>
            




            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->


<?php include('partials/footer.php'); ?>