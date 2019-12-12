<?php 
  include "includes/db.php";
  include "includes/header.php";
?>

<!-- Navigation -->
<?php 
  include "includes/navigation.php";
?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <?php
              if (isset($_GET['category'])) {
                $post_category_id = $_GET['category'];
              

                $query = "SELECT * FROM posts WHERE post_category_id = $post_category_id AND post_status = 'published'"; // constructing the query
                $select_all_posts_query = mysqli_query($connection, $query);

                if (mysqli_num_rows($select_all_posts_query) < 1) {
                  echo "<br><br><br><h1 class='text-center'>No Posts available</h1>";
                } else {
                        
                  // Had to put it in the while loop all else everything crashes
                  while($row = mysqli_fetch_assoc($select_all_posts_query)) {
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    // substr - creating an except, up to 200 characters long
                    $post_content = substr($row['post_content'], 0, 200);?>  

                    <!-- Post code starts -->
                    <h1 class="page-header">
                        Page Heading
                        <small>Secondary Text</small>
                    </h1>

                    <!-- First Blog Post -->
                    <h2>
                        <a href="post.php?p_id=<?php echo $post_id; ?>" title="<?php echo $post_title; ?>"><?php echo $post_title; ?></a>
                    </h2>
                    <p class="lead">
                        by <a href="index.php"><?php echo $post_author; ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                    <hr>
                    <a href="post.php?p_id=<?php echo $post_id; ?>" title="<?php echo $post_title; ?>">
                      <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="<?php echo $post_title; ?>">
                    </a>
                    <hr>
                    <p><?php echo $post_content; ?></p>
                    <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>" title="Read more">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                    <hr>
                    <!-- Post code ends -->
                <?php 
                  }
                }
              } else {
                header("Location: index.php");
              } 
            ?>



            <!-- Pager -->
            <ul class="pager">
                <li class="previous">
                    <a href="#">&larr; Older</a>
                </li>
                <li class="next">
                    <a href="#">Newer &rarr;</a>
                </li>
            </ul>

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php 
            include "includes/sidebar.php";
        ?>

    </div>
    <!-- /.row -->

    <hr>

<?php 
  include "includes/footer.php";
?>    