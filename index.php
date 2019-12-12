<?php 
  include "includes/db.php";
  include "includes/header.php";

  // Navigation
  include "includes/navigation.php";
  
?>


<!-- Page Content -->
<div class="container">

	<div class="row">

		<!-- Blog Entries Column -->
		<div class="col-md-8">

			<?php
				// For pagination code - start
				if (isset($_GET['page'])) {
					$page = $_GET['page'];
				} else {
					$page = "";
				}

				if ($page == "" || $page == 1) {
					$page1 = 0;
				} else {
					$page1 = ($page * 5) - 5;
				}
				// For pagination code - end

				// getting number of rows
				$post_query_count = "SELECT * FROM posts WHERE post_status = 'published'";
				$find_count = mysqli_query($connection, $post_query_count);
				$count = mysqli_num_rows($find_count);

				if ($count < 1) {
					
					echo "<br><br><br><h1 class='text-center'>No Posts available</h1>";
				} else {

					// calculate how many pages if we want 5 posts per page from above query
					$count = ceil($count / 5); // ceil rounds up


					$query = "SELECT * FROM posts LIMIT $page1, 5"; // constructing the query
					$select_all_posts_query = mysqli_query($connection, $query);
								
					// Had to put it in the while loop all else everything crashes
					while($row = mysqli_fetch_assoc($select_all_posts_query)) {
						$post_id = $row['post_id'];
						$post_title = $row['post_title'];
						$post_user = $row['post_user'];
						$post_date = $row['post_date'];
						$post_image = $row['post_image'];
						// substr - creating an except, up to 200 characters long
						$post_content = substr($row['post_content'], 0, 200);
						$post_status = $row['post_status'];					
					
						?> 
						<!-- First Blog Post -->
						<h2>
								<a href="post.php?p_id=<?php echo $post_id; ?>" title="<?php echo $post_title; ?>"><?php echo $post_title; ?></a>
						</h2>
						<p class="lead">
								by <a href="author_posts.php?author=<?php echo $post_user; ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_user; ?></a>
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
				
			?>



			<!-- Pager -->
			<ul class="pager">
				<?php 
					for ($i = 1; $i <= $count; $i++) {

						if ($i == $page) {
							echo "<li><a class='active-link' href='index.php?page={$i}'>{$i}</a></li>";
						} else {
							echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
						}
						
					}
				?>
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

</div>