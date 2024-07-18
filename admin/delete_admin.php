<?php 

// include constant.php file
include('../config/constants.php');

// 1. get id of admin to be deleted
$id = $_GET['id'];

// 2. create query to delete
$sql = "DELETE FROM tbl_admin WHERE id= $id ";

// 3. execute query

$res = mysqli_query($conn,$sql);

//4. check query executed or not 
if($res==TRUE){
    // success
    // creating session 
    $_SESSION['delete'] = "<div class ='success'> Admin Deleted Successfully </div>";

     // redirect page
     header("location:".SITEURL.'admin/manage_admin.php');
}
else{
    // failed
    $_SESSION['delete'] = "<div class ='error'>Failed to delete Admin</div>";

    // redirect page
    header("location:".SITEURL.'admin/manage_admin.php');        
}

// redirect to manage admin page with message
?>