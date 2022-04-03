<?php include('partials/menu.php'); ?>

<?php 
    $id = $_GET['id'];
    $sqlimg = "SELECT * FROM tbl_food WHERE id=$id";
    $res = mysqli_query($conn,$sqlimg);
    $rows = mysqli_fetch_assoc($res);
    $image_name = $rows['image_name'];
    unlink('../images/food/'.$image_name);
    $sql = "DELETE FROM tbl_food WHERE id=$id";
    $resf = mysqli_query($conn,$sql);
    if($resf==TRUE)
    {
        $_SESSION['del_food']="<div class='success google-font'>Food deleted successfully</div>";
        header('location:'.SITE_URL.'/admin/manage-food.php');
    }
    else{
        $_SESSION['del_food']="<div class='failure google-font'>Food deletion Failed</div>";
        header('location:'.SITE_URL.'/admin/manage-food.php');
    }
?>

<?php include('partials/footer.php'); ?>