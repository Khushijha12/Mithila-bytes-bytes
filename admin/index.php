<?php include ('partials/menu.php'); ?>

<!-- Main content Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>DASHBOARD</h1>
        <br><br>

        <?php
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }

        ?>
        <br><br>

               <!-- category -->
         
        <div class="col-4 text-center">

        <?php
        $sql = "SELECT * FROM tbl_category";

        $res = mysqli_query($conn , $sql);

        $count = mysqli_num_rows($res);

        ?>
            <h1><?php echo $count; ?></h1>
            <br>
            Categories
        </div>
     
              <!--  food -->
        <div class="col-4 text-center">

        <?php
        $sql2 = "SELECT * FROM tbl_food";

        $res2 = mysqli_query($conn , $sql2);

        $count2 = mysqli_num_rows($res2);

        ?>               
            <h1><?php echo $count2; ?></h1>
            <br>
            Foods
        </div>

                <!-- order    -->

        <div class="col-4 text-center">

        <?php
        $sql3 = "SELECT * FROM tbl_order";

        $res3 = mysqli_query($conn , $sql3);

        $count3 = mysqli_num_rows($res3);

        ?>              
            <h1><?php echo $count3; ?></h1>
            <br>
            Total orders
        </div>

                 <!-- REVENUE -->

        <div class="col-4 text-center">

        <?php 

        $sql4 = "SELECT SUM(total) AS Total from tbl_order WHERE status = 'Delivered' ";

        $res4 = mysqli_query($conn , $sql4);

        $row4 = mysqli_fetch_assoc($res4);

        $total_revenue = $row4['Total'];

        ?>
            <h1>₹<?php echo $total_revenue; ?></h1>
            <br>
            Revenue
        </div>

        <div class="clear-fix"></div>
    </div>
</div>
<!-- Menu  Sontent Section Ends -->

<?php include ('partials/footer.php'); ?>