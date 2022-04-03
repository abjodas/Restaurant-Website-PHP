<?php include('partials/menu.php') ?>;
<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br><br><br>
        <?php 
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text"name="full_name"placeholder="Enter your name"></td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td><input type="text"name="username"placeholder="username"></td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td><input type="password"name="password"placeholder="password"></td>
                    
                </tr>
                <tr>
                    <td colspan="2">
                        <br>
                        <input type="submit"name="submit"value="Add Admin"class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php') ?>

<?php 
    //Process the value from form and save it in database
    //Check whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        //Button clicked
        //echo 'Button clicked';

        //Get the data from form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); //Password Encryption with MD5
        
        //SQL Query to save the data in the database

        $sql = "INSERT INTO tbl_admin SET
        full_name='$full_name',
        username='$username',
        password='$password'
        ";
        //Executing Query and Saving Data in Database
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        //Check whether the data is inserted or not

        if($res == TRUE)
        {
            //Create a session variable to display message
            $_SESSION['add'] = "<div class='success'>Admin added successfully</div>";
            //Redirect page
            header("location:".SITE_URL.'admin/manage-admin.php');
        }
        else{
             //Create a session variable to display message
             $_SESSION['add'] = "<div class='failure'>Failed to add admin</div>";
             //Redirect page
             header("location:".SITE_URL.'admin/add-admin.php');
        }
        
    }
    

?>