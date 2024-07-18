<?php include ('../config/constants.php'); ?>


<?php
if (isset($_GET['id']) and isset($_GET['image_name'])) {

    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    if ($image_name != "") {
        $path = "../images/category/" . $image_name;
        $remove = unlink($path);

        if ($remove == false) {
            $_SESSION['remove'] = "<div class ='error'>Failed to remove category image</div>";
            header("location:" . SITEURL . 'admin/manage_category.php');
            die();
        }
    }

    $sql = "DELETE FROM tbl_category WHERE id=$id";

    $res = mysqli_query($conn, $sql);

    if ($res == TRUE) {
        // success
        // creating session 
        $_SESSION['delete'] = "<div class ='success'> category Deleted Successfully </div>";

        // redirect page
        header("location:" . SITEURL . 'admin/manage_category.php');
    } else {
        // failed
        $_SESSION['delete'] = "<div class ='error'>Failed to delete category</div>";

        // redirect page
        header("location:" . SITEURL . 'admin/manage_category.php');
    }

} else {

    header("location:" . SITEURL . 'admin/manage_category.php');

}
?>