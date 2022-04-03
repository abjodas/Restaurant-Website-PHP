<?php include('partials/menu.php') ?>


    <!-----Main content section starts---->
    <div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1>
        
        <br>
        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];//Displaying the session
                unset($_SESSION['add']);//Removing the session
            }
            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            if(isset($_SESSION['change_pass'])){
                echo $_SESSION['change_pass'];
                unset($_SESSION['change_pass']);
            }
        ?>
        <br>
        <br>
        <!---button to add admin--->
        <a href="add-admin.php" class="btn-primary">Add Admin</a>
        <br>
        <br>
        <br>
        <table class="tbl-full order">
            <tr>
                <th>S.N.</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>

            <tr>
                <?php 
                    $sql = "SELECT * FROM tbl_admin";

                    $res = mysqli_query($conn,$sql);

                    if($res == TRUE)
                    {
                        
                        $count = mysqli_num_rows($res);//Function to get the number of rows
                        if($count > 0)
                        {
                            $tid = 1;
                            while($rows = mysqli_fetch_assoc($res))
                            {
                                //USing while loop to get all the data from the database
                                //get individual data
                                $id = $rows['id'];
                                $full_name = $rows['full_name'];
                                $username = $rows['username'];

                                //Display the data in the table
                                ?>
                                 </tr>
                                 <tr>
                                     <td><?php echo $tid?></td>
                                     <td><?php echo $full_name?></td>
                                     <td><?php echo $username?></td>
                                     <td>
                                         <a href="<?php echo SITE_URL;?>admin/update-admin.php?id=<?php echo $id; ?>"class="btn-secondary">Update Admin</a>
                                         <a href="<?php echo SITE_URL;?>admin/delete-admin.php?id=<?php echo $id; ?>"class="btn-danger">Delete Admin</a>
                                         <a href="<?php echo SITE_URL;?>admin/change-password.php?id=<?php echo $id; ?>"class="btn-primary">Change Password</a>
                                     </td>
                                 </tr>
                                <?php
                                $tid+=1;
                            }
                        }
                        else{
                            //No data in database

                        }
                    }
                    
                
                ?>
            </tr>
           
        </table>
        <div class="clearfix"></div>
    </div>
    </div>
    <!-----Main content section ends---->

<?php include('partials/footer.php'); ?>