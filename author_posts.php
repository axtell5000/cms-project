<?php 
  include "includes/db.php";
	include "includes/header.php";
	include "includes/navigation.php";
?>

<!-- Page Content -->
<div class="container">

	<div class="row">

		<!-- Blog Entries Column -->
		<div class="col-md-8">

			<?php              
				if (isset($_GET['p_id'])) {
					$the_post_id = $_GET['p_id'];
					$the_post_author = $_GET['author'];
				}

				$query = "SELECT * FROM posts WHERE post_author = '{$the_post_author}' "; // constructing the query
				$select_all_posts_query = mysqli_query($connection, $query);
							
				// Had to put it in the while loop all else everything crashes
				while($row = mysqli_fetch_assoc($select_all_posts_query)) {
					$post_title = $row['post_title'];
					$post_author = $row['post_author'];
					$post_date = $row['post_date'];
					$post_image = $row['post_image'];
					$post_content = $row['post_content'];
					?> 

					<!-- First Blog Post -->
					<p class="lead">
						All  posts by <?php echo $post_author; ?>
					</p>
					
					<h2>
						<?php echo $post_title; ?>
					</h2>
					
					<p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
					<hr>
					<img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="<?php echo $post_title; ?>">
					<hr>
					<p><?php echo $post_content; ?></p>
					
					<hr>
					<!-- Post code ends -->

			<?php } ?>

					
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