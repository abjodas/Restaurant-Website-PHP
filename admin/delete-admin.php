<?php 

    include('../config/constants.php');
    
//1. Get the id of the admin to be deleted
    $id = $_GET['id'];
    


//2. Create SQL query to delete the admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";
    $res = mysqli_query($conn, $sql);

//Check Whether the Query Executed Successfully or no
    if($res==TRUE)
    {
        //Create a session variable to display the message
        $_SESSION['delete']="<div class='success'>Admin Deleted Successfully</div>";
        header('location:'.SITE_URL.'admin/manage-admin.php');
    }
    else{
        $_SESSION['delete']="<div class='failure'>Admin Deletion Failed</div>";
        header('location:'.SITE_URL.'admin/manage-admin.php');
    }
//3. Redirect to the manage-admin page with message Admin Deleted Successfully or Error

?>