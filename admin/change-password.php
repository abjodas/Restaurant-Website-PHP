<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

        <?php 
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];
            }
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Old Password: </td>
                    <td><input type="password" name="old_password"placeholder="Old Password"></td>
                </tr>

                <tr>
                    <td>New Password: </td>
                    <td><input type="password" name="new_password"placeholder="New Password"></td>
                </tr>

                <tr>
                <td>Confirm Password: </td>
                <td><input type="password" name="confirm_password"placeholder="Confirm Password"></td>
                </tr>

                <tr>
                    <td colspan="2"><input type="submit"name="submit"value="Change Password" class="btn-primary"></td>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    
                </tr>
            </table>
        </form>
    </div>
</div>

<?php 

    if(isset($_POST['submit']))
    {
        //1. Get the data from the form
            $id = $_POST['id'];
            $old_password = md5($_POST['old_password']);
            $new_password = md5($_POST['new_password']);
            $confirm_password = md5($_POST['confirm_password']);
        //2. Check whether the user with the current id and password exist or not

            $sql = "SELECT * from tbl_admin WHERE id=$id AND password='$old_password'";
            $res = mysqli_query($conn,$sql);
            if($res == TRUE)
            {
                $count = mysqli_num_rows($res);
                if($count == 1)
                {
                    //There exists an account with this id and password
                   
                    //3. Check whether the new password and confirm password match or not
                    if($new_password == $confirm_password)
                    {
                        //The passwords match
                        //4. Update the password using the query
                        $sql="UPDATE tbl_admin SET
                        password='$new_password'
                        WHERE id=$id
                        ";
                        $res2 = mysqli_query($conn,$sql);
                        if($res2)
                        {
                            $_SESSION['change_pass']="<div class='success'>The password was changed</div>";
                            header('location:'.SITE_URL.'admin/manage-admin.php');
                        }
                        else
                        {
                            $_SESSION['change_pass']="<div class='failure'>The password was not changed</div>";
                            header('location:'.SITE_URL.'admin/manage-admin.php');
                        }
                    }
                }
                else{
                    //There does not exist an account with this id and password
                    $_SESSION['change_pass']="<div class='failure'>User not found</div>";
                    header('location:'.SITE_URL.'admin/manage-admin.php');
                }
            }
            else
            {
                //Query was not executed
                $_SESSION['change_pass']="<div class='failure'>The password was not changed</div>";
                header('location:'.SITE_URL.'admin/manage-admin.php');
            }
        

        
    }

?>

<?php include('partials/footer.php') ?>