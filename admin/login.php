<?php include('../config/constants.php')?>
<html>
    <head>
        <title>Login Food Order System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
        <div class="login">
            <h1 class = "text-center">Login</h1>
            <br><br>

            <?php
             if (isset($_SESSION['login'])) {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }

            if (isset($_SESSION['no-login-message'])) {
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
            }

            ?>
            <br><br>

            <!-- login form start -->
            <form action="" method="post" class="text-center">
                Username: <br>
                <input type="text" name = "username" placeholder="Enter username"><br><br>
                Password:<br>
                <input type="password" name = "password" placeholder="Enter password"><br><br>
                 <input type="submit" name="submit" value="Login" class="btn-primary"> <br><br>

            </form>

            <!-- login end start -->

            <p class = "text-center">Created By - <a href="www.khushijha.com">Khushi Jha</a></p>
        </div>
    </body>
</html>

<?php
// check login button is clicked

if (isset($_POST["submit"])) {
    // process fot login
    $username = $_POST['username'];
    $password =md5( $_POST['password']);

    // check username and password in DB
    $sql = "SELECT * FROM tbl_admin WHERE username= '$username' AND password='$password'";

    $res = mysqli_query($conn,$sql);

    $count = mysqli_num_rows($res);

    if($count==1){

        $_SESSION['login'] = "<div class ='success'> Login  Successfull </div>";
        $_SESSION['user'] = "$username";

        // redirect page
        header("location:".SITEURL.'admin/');
   }
   else{
       // failed
       $_SESSION['login'] = "<div class ='error text-center'>Username or Password Incorrect</div>";
   
       // redirect page
       header("location:".SITEURL.'admin/login.php');        
   }


}


?>