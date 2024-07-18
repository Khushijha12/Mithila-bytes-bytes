<?php include ('partials/menu.php'); ?>

<div class="nain-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br><br>
        <?php

        // 1. get id of admin to be updated
        $id = $_GET['id'];

        // 2. create query to dget details
        $sql = "SELECT * FROM tbl_admin WHERE id=$id";

        // 3. execute query
        $res = mysqli_query($conn, $sql);


        //4. check query executed or not
        if ($res == TRUE) {
            $count = mysqli_num_rows($res);
            if ($count == 1) {
                $row = mysqli_fetch_assoc($res);

                $full_name = $row["full_name"];
                $username = $row["username"];



            } else {
                header("location:" . SITEURL . 'admin/manage_admin.php');
            }


        }




        ?>

        <form action="" method="post">
            <table class="tbl-add">

                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="full_name" value="<?php echo $full_name ?>"></td>
                </tr>

                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" value="<?php echo $username ?>"></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>

                </tr>



            </table>
        </form>
    </div>
</div>

<?php

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];

    $sql = "UPDATE tbl_admin SET 
    full_name = '$full_name',
    username = '$username' 
    WHERE id = '$id'
    ";

    // execute 
    $res= mysqli_query($conn, $sql);

    // check query executed successfully
    if ($res == TRUE) {
        $_SESSION['update'] = "<div class ='success'>Admin updated successfully</div>";

        header("location:".SITEURL.'admin/manage_admin.php');
    }

    else{

    $_SESSION['update'] = "<div class ='error'>Failed to update Admin</div>";

    // redirect page
    header("location:".SITEURL.'admin/manage_admin.php'); 

    }




}


?>



<?php include ('partials/footer.php'); ?>