<?php include('partials/menu.php'); 
    $id = $_GET['id'];
    $getimg="SELECT * FROM tbl_category WHERE id=$id";
    $ress = mysqli_query($conn,$getimg);
    $rows = mysqli_fetch_assoc($ress);
    $image_name = $rows['image_name'];
    unlink('../images/category/'.$image_name);
    $sql = "DELETE FROM tbl_category WHERE id=$id";
    $res = mysqli_query($conn,$sql);
    if($res == TRUE){
        $_SESSION['delete-cat']="<div class='success google-font'>The category was deleted successfully</div>";
        header('location:'.SITE_URL.'admin/manage-category.php');
    }
    else{
        $_SESSION['delete-cat']="<div class='failure google-font'>The category was not deleted</div>";
        header('location:'.SITE_URL.'admin/manage-category.php');
    }
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Delete Category</h1>
    
    </div>
</div>

<?php include('partials/footer.php'); ?>