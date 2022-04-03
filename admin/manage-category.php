<?php include('partials/menu.php') ?>

<div class="main-content">
<div class="wrapper">
    <h1>Manage Category</h1>
    <br>
        <br>
        <?php 
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            if(isset($_SESSION['delete-cat'])){
                echo $_SESSION['delete-cat'];
                unset($_SESSION['delete-cat']);
            }
        ?>
        <br>

        <!---button to add admin--->
        <a href="<?php echo SITE_URL;?>admin/add-category.php" class="btn-primary">Add Category</a>
        <br>
        <br>
        <br>
        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Image Name</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
            <tr>
            <?php  
                $sql="SELECT * FROM tbl_category";
                $res=mysqli_query($conn,$sql);
                if($res==TRUE)
                {
                    $count = mysqli_num_rows($res);
                    if($count >0)
                    {
                        $tid=1;
                        while($rows=mysqli_fetch_assoc($res))
                        {
                            $id=$rows['id'];
                            $title=$rows['title'];
                            $image_name=$rows['image_name'];
                            $featured=$rows['featured'];
                            $active=$rows['active'];
                            ?>
                            <td><?php echo $tid; ?></td>
                            <td><?php echo $title; ?></td>
                            <td><img src="../images/category/<?php echo $image_name; ?>" class="cat_img"></td>
                            <td><?php echo $featured; ?></td>
                            <td><?php echo $active; ?></td>
                            <td>
                                <a href="<?php echo SITE_URL; ?>admin/update-category.php?id=<?php echo $id; ?>"class="btn-secondary">Update Category</a>
                                <a href="<?php echo SITE_URL; ?>admin/delete-category.php?id=<?php echo $id; ?>"class="btn-danger">Delete Category</a>
                            </td>
            </tr> <?php $tid+=1;
                        }
                    }
                    else{
                        //No data in the database
                    }
                }
                else{
                    echo "<div class='failure'>Could not connect to the database</div>";
                }
               
            ?>
                
            
        </table>
</div>
</div>

<?php include('partials/footer.php') ?>