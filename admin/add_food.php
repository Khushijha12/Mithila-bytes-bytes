<?php include ("partials/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>

        <?php
        
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        ?>

        <br><br>
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-add">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Food Title">
                    </td>
                </tr>

                <tr>
                    <td>Description:</td>
                    <td>
                       <textarea name="description" cols="30" rows="5" placeholder="Description of food"></textarea> 
                    </td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

               
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category" >

                            <?php

                            // create php to display category from database

                            // create sql to get all active category

                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                            // display on add food
                            $res = mysqli_query($conn,$sql);
                            $count = mysqli_num_rows($res);

                            if ($count > 0) 
                            {
                                while ($row = mysqli_fetch_assoc($res))
                                {
                                    // get details of category
                                    $id = $row['id'];
                                    $title = $row['title'];
                                    ?>

                                    <option value="<?php echo $id; ?>"><?php echo $title;?></option>


                                    <?php
                                }

                            }

                            else
                            {
                                ?>

                                <option value="0">No active category found</option>


                                <?php
                            }

                            ?>

                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>


                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>

                </tr>

            </table>
        </form>


        
        <?php

        if (isset($_POST['submit'])) 
        {
            // get data

            $title = $_POST['title'];

            $description = $_POST['description'];

            $price = $_POST['price'];

            $category = $_POST['category'];

            if (isset($_POST['featured'])) {
                $featured = $_POST['featured'];
            } else {
                $featured = 'No';
            }


            if (isset($_POST['active'])) {
                $active = $_POST['active'];
            } else {
                $active = 'No';
            }


            // upload image if slected

            if (isset($_FILES['image']['name'])) 
            {
                $image_name = $_FILES['image']['name'];

                if ($image_name != "") 
                {
                    $file_parts = explode('.', $image_name);
                    $ext = end($file_parts);

                    $image_name = "Food_name_" . rand(0000, 9999) . '.' . $ext;

                    $source_path = $_FILES['image']['tmp_name'];


                    $destination_path = '../images/food/' . $image_name;

                    $upload = move_uploaded_file($source_path, $destination_path);

                    if ($upload == false) {
                        $_SESSION['upload'] = "<div class = 'error'>Failed to upload image</div>";
                        header("location:" . SITEURL . 'admin/add_food.php');

                        // stop the process
                        die();

                    }

                }


            }

            else
            {
                $image_name = "";

            }



            // insert in db

            $sql2 = "INSERT INTO tbl_food SET

            title = '$title',
            description = '$description',
            price = '$price',
            image_name = '$image_name',
            category_id = $category, 
            featured = '$featured',
            active = '$active'
            ";

            
            $res2 = mysqli_query($conn, $sql2);




            // redirect to manage food

            if ($res2 == TRUE) {
                $_SESSION['add'] = "<div class='success'>Food Added Successfully</div>";

                // redirect page
                header("location:" . SITEURL . 'admin/manage_food.php');

            } else {
                // echo "failed";
                $_SESSION['add'] = "<div class='error'>Failed to add food</div>";

                // redirect page
                header("location:" . SITEURL . 'admin/add_food.php');


            }


        
        }
        ?>

    </div>
</div>



<?php include ("partials/footer.php"); ?>