<?php include ('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <br>
        <br>
        <?php

        if (isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        ?>


        <form action="" method="post">

            <table class="tbl-add">
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="full_name" placeholder="Enter Your Name"></td>
                </tr>

                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" placeholder="Your Username"></td>
                </tr>

                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" placeholder="Your Password"></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>

                </tr>


            </table>
        </form>
    </div>
</div>

<?php include ('partials/footer.php'); ?>

<?php
//  process the value from form and save in DB

if (isset($_POST['submit'])) {
    // button clicked
    // echo'Button Clicked';

    // 1. get data from form

    $full_name =$_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); // password encryption with md5


    //2.  sql query to save DB

    $sql="INSERT INTO tbl_admin SET 
    full_name = '$full_name',
    username = '$username',
    password = '$password'
    ";

    // 3. executing qurery and saving data into DB

    $res = mysqli_query($conn , $sql) or die (mysqli_error($conn));

    // 4. check whether data is inserted or not

    if ($res==TRUE) {
        // echo"data inserted";
        // create a session variable to display message
        $_SESSION['add'] = "Admin Added Successfully";

        // redirect page
        header("location:".SITEURL.'admin/manage_admin.php');

    }
    else {
        // echo "failed";
        $_SESSION['add'] = "Failed to add Admin";

        // redirect page
        header("location:".SITEURL.'admin/add_admin.php');        
    }

}

?>