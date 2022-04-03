<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <?php 
        $id = $_GET['id'];
        $sql="SELECT * FROM tbl_category WHERE id=$id";
        $res=mysqli_query($conn,$sql);
        $rows = mysqli_fetch_assoc($res);
        $image_name = $rows['image_name'];
        $flag=0;
        if($image_name){
            $flag=1;
        }
        $count=mysqli_num_rows($res);
        if($count==1)
        {
            
            $title=$rows['title'];
            $featured=$rows['featured'];
            $active=$rows['active'];
        }
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
        <!---Start of the form--->
        <table class="tbl-30">
        <tr>
            <td>Title: </td>
            <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
        </tr>
        <tr>
            <td>Select Image: </td>
            <td>
            <input type="file" name="image">
            </td>
        </tr>
        <tr>
            <td>Featured: </td>
            <td><input type="radio" name="featured" value="Yes" <?php if($featured=="Yes")echo "checked"; ?>> Yes
            <input type="radio" name="featured" value="No"<?php if($featured=="No")echo "checked"; ?>> No
            </td>
        </tr>
        <tr>
            <td>Active: </td>
            <td><input type="radio" name="active" value="Yes" <?php if($active=="Yes")echo "checked"; ?>> Yes
            <input type="radio" name="active" value="No"<?php if($active=="No")echo "checked"; ?>> No
            </td>
        </tr>
        <tr>
        <br>
            <td colspan="2"><input type="submit" name="submit" value="Update Category" class="btn-secondary"></td>
        </tr>
        </table>
        <!---End of the form--->
        </form>
        <?php 
            if(isset($_POST['submit']))
            {

                $title = $_POST['title'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];
                
                if($flag==1 && $_FILES['image']['size']>0)
                {
                    unlink('../images/category/'.$image_name);
                }
                if($flag==1 && $_FILES['image']['size']==0)
                {
                    $sql = "UPDATE tbl_category SET
                title='$title',
                featured='$featured',
                active='$active'
                WHERE id=$id";
                $res=mysqli_query($conn,$sql);
                if($res==TRUE)
                {
                    $_SESSION['update']="<div class='success google-font'>Category Updated Successfully</div>";
                    header('location:'.SITE_URL.'admin/manage-category.php');
                    die();
                }
                else{
                    $_SESSION['update']="<div class='failure google-font'>Category Updated Failed</div>";
                    header('location:'.SITE_URL.'admin/manage-category.php');
                    die();
                }
                
                }

                if(isset($_FILES['image']['name']))//Name property is not empty and thus the image is uploaded
                {
                    //Upload the image
                    //To upload the image we need image name and source path and destination path
                    $image_name = $_FILES['image']['name'];

                    //Auto Rename the image
                    //Get the extension of the image
                    $ext = end(explode('.',$image_name));

                    //Rename the image
                    $image_name = "Food_Category_".date('m-d-Y_hisa').'.'.$ext; //Attaching date and time with the file name

                    $source_path = $_FILES['image']['tmp_name'];
                    $dest_path = "../images/category/".$image_name;

                    $image_type = $_FILES['image']['type'];

                    $pattern = "#image#i";

                    
                    if(preg_match($pattern,$image_type)) //Checking whether the type is image or not
                    {
                        
                    //Upload the image
                    $upload = move_uploaded_file($source_path,$dest_path);

                    
                    //Check whether the image is uploaded or not
                    //And if the image is not uploaded then we will stop the process and redirect with error message
                    if($upload == FALSE){
                        $_SESSION['upload']="<div class='failure google-font'>Failed to upload the image</div>";
                        header('location:'.SITE_URL.'admin/add-category.php');
                        //Stop the process
                        die();
                    }
                    
                }
                else{ //The file is not an image file
                    $_SESSION['upload']="<div class='failure google-font'>Please Choose An Image File</div>";
                    header('location:'.SITE_URL.'admin/update-category.php?id='.$id);
                    die();
                }
                }

                $sql = "UPDATE tbl_category SET
                title='$title',
                image_name='$image_name',
                featured='$featured',
                active='$active'
                WHERE id=$id";
                $res=mysqli_query($conn,$sql);
                if($res==TRUE)
                {
                    $_SESSION['update']="<div class='success google-font'>Category Updated Successfully</div>";
                    header('location:'.SITE_URL.'admin/manage-category.php');
                }
                else{
                    $_SESSION['update']="<div class='failure google-font'>Category Updated Failed</div>";
                    header('location:'.SITE_URL.'admin/manage-category.php');
                }
            }
        ?>

    </div>
</div>
<?php include('partials/footer.php'); ?>