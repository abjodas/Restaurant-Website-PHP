<?php include('../config/constants.php');
        include('login-check.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Teko:wght@500&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    
    <title>Food Order Website-Hoempage</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
<div class="menu text-center">
        <div class="wrapper">
        <ul>
            <li>
                <a href="index.php">Home</a></li>
            <li><a href="<?php echo SITE_URL; ?>admin/manage-admin.php">Admin</a></li>
            <li><a href="<?php echo SITE_URL; ?>admin/manage-category.php">Category</a></li>
            <li><a href="<?php echo SITE_URL; ?>admin/manage-food.php">Food</a></li>
            <li><a href="<?php echo SITE_URL; ?>admin/manage-order.php">Order</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
        </div>
    </div>
