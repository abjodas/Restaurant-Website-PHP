<?php include('partials/menu.php') ?>

<div class="main-content">
<div class="wrapper">
    <h1>Manage Food</h1>

    <?php
        if(isset($_SESSION['del_food']))
        {
            echo $_SESSION['del_food'];
            unset($_SESSION['del_food']);
        }
        if(isset($_SESSION['update_food']))
        {
            echo $_SESSION['update_food'];
            unset($_SESSION['update_food']);
        }
    ?>
    <br>
        <br>
        <br>
        <!---button to add admin--->
        <a href="<?php echo SITE_URL; ?>/admin/add-food.php" class="btn-primary">Add Food</a>
        <br>
        <br>
        <br>
        <table class="tbl-full">
            <tr>
                <th width="5%">S.N.</th>
                <th width="10%">Food Name</th>
                <th width="25%">Description</th>
                <th width="5%">Price</th>
                <th width="15%">Image</th>
                <th width="10%">Category</th>
                <th width="5%">Featured</th>
                <th width="5%">Active</th>
                <th width="20%">Actions</th>
            </tr>
            <tr>
            <?php
                $sql = "SELECT * FROM tbl_food";
                $res = mysqli_query($conn,$sql);
                $count = 1;
                while($rows=mysqli_fetch_assoc($res))
                {
                    ?> 

                <td><?php echo $count; ?></td>
                <td><?php echo $rows['title'] ?></td>
                <td><?php echo $rows['description'] ?></td>
                <td>$<?php echo $rows['price'] ?></td>
                <td><img src="../images/food/<?php echo $rows['image_name']; ?>" class="cat_img"></td>
                <td>
                <?php
                    $category_id = $rows['category_id'];
                    $sql = "SELECT * FROM tbl_category WHERE id=$category_id";

                    $res_cat = mysqli_query($conn,$sql);
                    $cat_rows = mysqli_fetch_assoc($res_cat);
                    echo $cat_rows['title'];
                    $id = $rows['id'];
                ?>
                </td>
                <td><?php echo $rows['featured']; ?></td>
                <td><?php echo $rows['active']; ?></td>
                <td>
                    <a href="<?php echo SITE_URL; ?>admin/update-food.php?id=<?php echo $id; ?>"class="btn-secondary">Update Food</a>
                    <a href="<?php echo SITE_URL; ?>admin/delete-food.php?id=<?php echo $id; ?>"class="btn-danger">Delete Food</a>
                </td>
            </tr>
                    <?php
                    $count++;
                }
            ?>
                
            
        </table>
</div>
</div>

<?php include('partials/footer.php') ?>