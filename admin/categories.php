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
                            <?php insert_categories(); ?>                            
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
                                    <!-- Find all categories -->
                                    <?php findAllCategories(); ?>
                                    
                                    <!-- Deleting a category  -->
                                    <?php deleteCategories(); ?>
                                    
                         
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