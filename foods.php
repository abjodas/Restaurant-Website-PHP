<?php include('partials/menu.php'); ?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITE_URL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php  
                $sql = "SELECT * FROM tbl_food WHERE active='Yes'";
                $res = mysqli_query($conn,$sql);

                while($rows = mysqli_fetch_assoc($res))
                {
                    $id = $rows['id'];

                    ?>

            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="<?php echo SITE_URL; ?>images/food/<?php echo $rows['image_name']; ?>" class="img-responsive img-curve">
                </div>

                <div class="food-menu-desc">
                    <h4><?php echo $rows['title'] ?></h4>
                    <p class="food-price"><?php echo $rows['price']; ?></p>
                    <p class="food-detail">
                        <?php echo $rows['description']; ?>
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

        <p class="text-center">
            <a href="<?php echo SITE_URL; ?>foods.php">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->
    <?php include('partials/footer.php'); ?>