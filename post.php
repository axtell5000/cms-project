<?php 
 	include "includes/db.php";
	include "includes/header.php";
	include "includes/navigation.php";
	include "./admin/functions.php";
?>

<!-- Page Content -->
<div class="container">

	<div class="row">

		<!-- Blog Entries Column -->
		<div class="col-md-8">

			<?php              
				if (isset($_GET['p_id'])) {
					$the_post_id = $_GET['p_id'];
				
					$view_query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = $the_post_id";
					$send_query = mysqli_query($connection, $view_query);
					if (!$send_query) {
						die('QUERY FAILED' . mysqli_error($connection));
					}

					$query = "SELECT * FROM posts WHERE post_id = $the_post_id "; // constructing the query
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
					<h2>
						<?php echo $post_title; ?>
					</h2>
					<p class="lead">
						by <a href="index.php"><?php echo $post_author; ?></a>
					</p>
					<p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
					<hr>
					<img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="<?php echo $post_title; ?>">
					<hr>
					<p><?php echo $post_content; ?></p>
					
					<hr>
					<!-- Post code ends -->
				<?php 
				}

			
				// Comments start
				if (isset($_POST['create_comment'])) {

					$the_post_id = escape($_GET['p_id']);
					$comment_author = escape($_POST['comment_author']);
					$comment_email = escape($_POST['comment_email']);
					$comment_content = escape($_POST['comment_content']);

					// for form validation
					if (!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {
						
						$query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status,comment_date) ";

						$query .= "VALUES ($the_post_id ,'{$comment_author}', '{$comment_email}', '{$comment_content }', 'unapproved',now())";

						$create_comment_query = mysqli_query($connection, $query);

						if (!$create_comment_query) {
							die('QUERY FAILED' . mysqli_error($connection));
						}
						
						$query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $the_post_id";
						$update_comment_count = mysqli_query($connection, $query);
					} else {
						echo "<script>alert('Field cannot be empty')</script>";
					}
		
				}
			?>

				<!-- Comments Form -->
				<div class="well">
					<h4>Leave a Comment:</h4>
					<form role="form" action="" method="post">
						<div class="form-group">
							<label for="comment_author">Author</label>
							<input type="text" class="form-control" id="comment_author" name="comment_author">
						</div>
						<div class="form-group">
							<label for="email">Email</label>
							<input type="email" class="form-control" id="email" name="comment_email">
						</div>
						<div class="form-group">
						<label for="comment_content">Your Comment</label>
							<textarea name="comment_content" id="comment_content" class="form-control" rows="3"></textarea>
						</div>
						<button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
					</form>
				</div>

				<hr>
				
			<!-- Posted Comments -->
			<?php 
				$query = "SELECT * FROM comments WHERE comment_post_id = {$the_post_id} ";
				$query .= "AND comment_status = 'approved' ";
				$query .= "ORDER BY comment_id DESC";
				$select_comment_query = mysqli_query($connection, $query);

				if(!$select_comment_query) {
					die('Query Failed'.mysqli_error($connection));
				}
				
				while($row = mysqli_fetch_array($select_comment_query)) {
					$comment_author      = $row['comment_author'];
					$comment_content     = $row['comment_content'];
					$comment_date        = $row['comment_date']; 
					
				?>
				
				<!-- Comment -->
				<div class="media">
					<a class="pull-left" href="#">
						<img class="media-object" src="http://placehold.it/64x64" alt="">
					</a>
					<div class="media-body">
						<h4 class="media-heading"><?php echo $comment_author ?>
							<small><?php echo $comment_date ?></small>
						</h4>
						<?php echo $comment_content ?>
					</div>
				</div>   

			<?php }

			} else {
					header('Location: index.php');
				} 
			?>
					
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