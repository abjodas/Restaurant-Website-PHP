<?php 
    include('partials/menu.php');
?>


    <!-----Main content section starts---->
    <div class="main-content">
    <div class="wrapper">
        <h1>Dashboard</h1>
        <br>
        <?php 
            if(isset($_SESSION['login-success']))
            {
                echo $_SESSION['login-success'];
                unset($_SESSION['login-success']);
            }
        ?>
        <div class="col-4 text-center">
            <h1>5</h1>
            <br>
            Categories
        </div>
        <div class="col-4 text-center">
            <h1>5</h1>
            <br>
            Categories
        </div>
        <div class="col-4 text-center">
            <h1>5</h1>
            <br>
            Categories
        </div>
        <div class="col-4 text-center">
            <h1>5</h1>
            <br>
            Categories
        </div>
        <div class="clearfix"></div>
        </div>
    </div>
    <!-----Main content section ends---->


<?php include('partials/footer.php'); ?>

