<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
    <h1>Update Food</h1>
    <br>
    <?php
        if(isset($_SESSION['empty']))
        {
            echo $_SESSION['empty'];
            unset($_SESSION['empty']);
        }
        $id = $_GET['id'];
        $sql = "SELECT * FROM tbl_food WHERE id=$id";
        $res = mysqli_query($conn,$sql);
        $rows = mysqli_fetch_assoc($res);
        $title = $rows['title'];
        $description = $rows['description'];
        $price = $rows['price'];
        $category = $rows['category_id'];
        $featured = $rows['featured'];
        $active = $rows['active'];
        $set_image_name = $rows['image_name'];
        
                
    ?>
    <br>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td><textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea></td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td><input type="number" name="price" value="<?php echo $price; ?>"></td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
                            <?php 
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                                $res = mysqli_query($conn,$sql);
                                if($res==TRUE)
                                {
                                    $count = mysqli_num_rows($res);
                                    if($count>0)
                                    {
                                        while($rows=mysqli_fetch_assoc($res))
                                        {
                                        ?>
                                        <option value="<?php echo $rows['id'];?>"><?php echo $rows['title']?></option>
                                        <?php
                                        }
                                    }
                                    else{
                                        ?>
                                        <option value="0">No Categories Found</option>
                                        <?php
                                    }
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No" checked>No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No" checked>No
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="submit" value="Add Food" class="btn-secondary"></td>
                </tr>
            </table>
        </form>
        <?php
            if(isset($_POST['submit']))
            {
                //Add the food in database

                //1. Get the data from the form
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];
                $category_sel = $_POST['category'];
                $image_name = $_FILES['image']['name'];
                
                //2.Upload the image

                
                $pattern = "#image#i";
                $image_type = $_FILES['image']['type'];
                if(!empty($_FILES['image']['name']) && !preg_match($pattern, $image_type))
                {
                    $_SESSION['sel_img']="<div class='failure google-font'>Other File Type Selected</div>";
                    header('location:'.SITE_URL.'/admin/manage-food.php');
                    die();
                }
                else //Correct Image File selected
                {
                    if($title)
                    {
                        if(!empty($image_name))
                        {
                        $tmp = explode('.',$image_name);
                        $ext = end($tmp);
                        $image_name = "Food_Name_".date('m-d-Y_hisa').'.'.$ext;

                        $source_path = $_FILES['image']['tmp_name'];
                        $dest_path = '../images/food/'.$image_name;

                        $upload = move_uploaded_file($source_path,$dest_path);
                        unlink('../images/food/'.$set_image_name);    
                        if($upload == FALSE) //Upload Failed Due to Some Reason
                        {
                            $_SESSION['upload_failed']="<div class='failure google-font'>File Was Not Uploaded</div>";
                            header('location:'.SITE_URL.'/admin/manage-food.php');
                            die();
                        }
                        }
                        else
                        {
                            $image_name = $set_image_name;
                        }
                        //Write the SQL Query

                        $sql = "UPDATE tbl_food SET
                        title = '$title',
                        description = '$description',
                        price = $price,
                        image_name = '$image_name',
                        category_id = $category_sel,
                        featured = '$featured',
                        active = '$active'
                        WHERE id=$id
                        ";
                        //Executing my SQL Query
                        $res = mysqli_query($conn,$sql);
                        if($res==TRUE)
                        {
                            $_SESSION['update_food'] = "<div class='success google-font'>Food Added Successfully</div>";
                            header('location:'.SITE_URL.'/admin/manage-food.php');
                            die();
                        }
                        else{
                            $_SESSION['update_food'] = "<div class='failure google-font'>Food Was Not Added</div>";
                            header('location:'.SITE_URL.'/admin/manage-food.php');
                            die();
                        }
                    }
                    else
                    {
                        //No title is given
                        $_SESSION['empty'] = "<div class='failure google-font'>Please Give a Title</div>";
                        header('location:'.SITE_URL.'/admin/update-food.php');
                        die();
                    }
                }
                //3.Write the sql query for storing data in database
            }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>