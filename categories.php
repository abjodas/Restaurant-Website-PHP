<?php include('partials/menu.php'); ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <?php 
                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                $res = mysqli_query($conn,$sql);

                while($rows=mysqli_fetch_assoc($res))
                {   
                    $id=$rows['id'];

                    ?>
                <a href="<?php echo SITE_URL; ?>category-foods.php?id=<?php echo $id; ?>">
                <div class="box-3 float-container">
                    <img src="<?php echo SITE_URL; ?>images/category/<?php echo $rows['image_name'];?>"class="img-responsive img-curve">

                    <h3 class="float-text text-white"><?php echo $rows['title']; ?></h3>
                </div>
                </a>
                    <?php

                }
            ?>

            <a href="category-foods.html">
            <div class="box-3 float-container">
                <img src="images/pizza.jpg" alt="Pizza" class="img-responsive img-curve">

                <h3 class="float-text text-white">Pizza</h3>
            </div>
            </a>

            

            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <?php include('partials/footer.php'); ?>