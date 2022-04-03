<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <?php 
        if(isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
        <!---Start of the form--->
        <table class="tbl-30">
        <tr>
            <td>Title: </td>
            <td><input type="text" name="title" placeholder="Category Title"></td>
        </tr>
        <tr>
            <td>Select Image: </td>
            <td>
            <input type="file" name="image">
            </td>
        </tr>
        <tr>
            <td>Featured: </td>
            <td><input type="radio" name="featured" value="Yes"> Yes
            <input type="radio" name="featured" value="No"> No
            </td>
        </tr>
        <tr>
            <td>Active: </td>
            <td><input type="radio" name="active" value="Yes"> Yes
            <input type="radio" name="active" value="No"> No
            </td>
        </tr>
        <tr>
        <br>
            <td colspan="2"><input type="submit" name="submit" value="Add Category" class="btn-secondary"></td>
        </tr>
        </table>
        <!---End of the form--->
        </form>

        <?php 
            if(isset($_POST['submit'])){
                //Submit button is clicked
                //Get the value from the form
                $title = $_POST['title'];

                if(!$title)
                {
                    $_SESSION['add']="<div class='failure google-font'>Please Select a Title</div>";
                    header('location:'.SITE_URL.'admin/add-category.php');
                    die();
                }
                
                //For radio input type, we need to check whether the button is selected or not
                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];
                }
                else{
                    $featured = "No"; //Default value
                }
                if(isset($_POST['active'])){
                    $active = $_POST['active'];
                }
                else{
                    $active = "No";
                }
                //Check whether the image is selected or not
                //print_r($_FILES['image']);

                

                //die(); //Break the code

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
                    header('location:'.SITE_URL.'admin/add-category.php');
                    die();
                }
                }
                

                //Write the sql query
                $sql = "INSERT INTO tbl_category SET
                title='$title',
                image_name='$image_name',
                featured='$featured',
                active='$active'
                ";
                $res=mysqli_query($conn,$sql);//Execute the sql query
                //Check whether the query executed sucessfully
                if($res==TRUE)
                {
                    $_SESSION['add']="<div class='success google-font'>Category Added Successfully</div>";
                    header('location:'.SITE_URL.'admin/add-category.php');
                }
                else{
                    $_SESSION['add']="<div class='failure google-font'>Failed to Add Category</div>";
                    header('location:'.SITE_URL.'admin/add-category.php');
                }

            }
        ?>
    </div>
</div>
<?php include('partials/footer.php')  ?>