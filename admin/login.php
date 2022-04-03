<?php include('../config/constants.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Teko:wght@500&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    
    <title>Login Food Order System</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
<div>
    <div class="login">
        <h1 class="text-center">Login</h1>
        <br>
        <?php 
            if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
            if(isset($_SESSION['no-login']))
            {
                echo $_SESSION['no-login'];
                unset($_SESSION['no-login']);
            }
        ?>
        <br>
        <!---Login form starts here ---->
        <form action="" method="POST" class="text-center">
            Username:
            <input type="text" name="username" placeholder="Enter username">
            <p></p>
            <br>
            Password:
            <input type="password" name="password" placeholder="Enter password">
            <br><br>
            <p>
            <input type="submit" name="submit" value="login" class="btn-primary set-width"></p>
        </form>
        <br>
       
        <br>
        <p class="text-center">Created by <a href="#">Abhishek Das</a></p>
    </div>

</body>
</html>

<?php
    
    if(isset($_POST['submit']))
    {
        //The button is clicked and we need to process for login
        //1.Get the data from the form
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        //2.Create an SQL query to check whether this username and password exist or not
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        $res = mysqli_query($conn,$sql);
        if($res == TRUE)
        {
            //echo "The query was successfully executed";
            $count = mysqli_num_rows($res);//Count the number of users with this username and password
            if($count == 1)
            {
                //There exists only one user with this username and password
                $_SESSION['login-success']="<div class='success google-font'>You have successfully logged in</div>";
                $_SESSION['user']=$username;//TO check whether the user is logged in or not and logout will unset it
                header('location:'.SITE_URL.'admin/');
            }
            else{
                //There is some fault as there exists multiple users with this username and password or no users exist
                $_SESSION['login']="<div class='failure text-center google-font'>User Account Does Not exist</div>";
                header('location:'.SITE_URL.'admin/login.php');
            }
        }
        else{
            echo "The query failed";
        }
        
    }

?>

