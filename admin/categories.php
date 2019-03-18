<?php include "includes/header.php" ?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/navigation.php" ?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           Welcome to admin
                            <small>Author</small>
                        </h1>

                        <div class="col-xs-6">

                            <?php
                                // Adding a category 
                                if (isset($_POST['submit'])) {
                                    $cat_title = $_POST['cat_title'];

                                    if($cat_title == "" || empty($cat_title)) {
                                        echo "This field should not be empty";
                                    } else {
                                        $query = "INSERT INTO categories(cat_title) ";
                                        $query .= "VALUES('{$cat_title}') ";

                                        $create_category_query = mysqli_query($connection, $query);

                                        if (!$create_category_query) {
                                            die("Query Failed" . mysqli_error($connection));
                                        }
                                    }
                                }
                            ?>
                            
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="cat_title">Add Category</label>
                                    <input class="form-control" type="text" name="cat_title" placeholder="Enter category">                            
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                                </div>
                            </form>

                            <?php 
                                if (isset($_GET['edit'])) {
                                    $cat_id = $_GET['edit'];                                    
                                    include "includes/update_categories.php";
                                }
                            ?>
                           
                            
                        </div>
                        <div class="col-xs-6">
                           
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category Title</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php 
                                         $query = "SELECT * FROM categories"; // constructing the query
                                         $select_categories = mysqli_query($connection, $query);

                                        // Had to put it in the while loop all else everything crashes
                                        while($row = mysqli_fetch_assoc($select_categories)) {
                                            $cat_id = $row['cat_id'];
                                            $cat_title = $row['cat_title'];
                                            echo "<tr>
                                                    <td>{$cat_id}</td>
                                                    <td>{$cat_title}</td>
                                                    <td><a href='categories.php?delete={$cat_id}'>Delete</a></td>
                                                    <td><a href='categories.php?edit={$cat_id}'>Edit</a></td>
                                                  </tr>";
                                        }                                
                                    ?>

                                    <?php
                                        // Deleting a category  
                                        if (isset($_GET['delete'])) {
                                            $the_cat_id = $_GET['delete'];
                                            $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id} ";
                                            $delete_query = mysqli_query($connection, $query);
                                            header("Location: categories.php");
                                        }
                                    ?>
                                    
                         
                                </tbody>
                            </table>
                        </div>
              
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <?php include "includes/footer.php" ?>