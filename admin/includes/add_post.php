
<?php  

  if(isset($_POST['create_post'])) {
    $post_title        = escape($_POST['title']);
    $post_user         = escape($_POST['post_user']);
    $post_category_id  = escape($_POST['post_category']);
    $post_status       = escape($_POST['post_status']);

    $post_image        = escape($_FILES['image']['name']);
    $post_image_temp   = escape($_FILES['image']['tmp_name']);

    $post_tags         = escape($_POST['post_tags']);
    $post_content      = escape($_POST['post_content']);
    $post_date         = date('d-m-y');
    

    move_uploaded_file($post_image_temp, "../images/$post_image");

    $query = "INSERT INTO posts(post_category_id, post_title, post_user, post_date, post_image, post_content, post_tags, post_status) ";
    $query .= "VALUES({$post_category_id},'{$post_title}','{$post_user}',now(),'{$post_image}','{$post_content}','{$post_tags}', '{$post_status}') "; 
    $create_post_query = mysqli_query($connection, $query);
    
    confirmQuery($create_post_query);

    $the_post_id = mysqli_insert_id($connection);

    echo "<p class='bg-success'>Post Created. <a href='../post.php?p_id={$the_post_id}' title='View Post'>View Post</a> or 
    <a href='posts.php' title='Edit More Posts'>Edit More Posts</a></p>";
  }

?>

<!-- BIG NB - enctype="multipart/form-data" means sending different form data e.g images -->
<form action="" method="post" enctype="multipart/form-data">         
  
  <div class="form-group">
    <label for="title">Post Title</label>
    <input type="text" class="form-control" id="title" name="title">
  </div>

  <div class="form-group">
    <label for="post_category">Category</label>
    <select name="post_category" id="post_category" class="form-control">
    <?php
      $query = "SELECT * FROM categories"; // constructing the query
      $select_categories = mysqli_query($connection, $query);

      confirmQuery($select_categories);

      // Had to put it in the while loop all else everything crashes
      while($row = mysqli_fetch_assoc($select_categories)) {
          $cat_id = $row['cat_id'];
          $cat_title = $row['cat_title'];

          echo "<option value='{$cat_id}'>{$cat_title}</option>";
      }
    ?>
    
    </select>
  </div>

  <div class="form-group">
    <label for="post_user">User</label>
    <select name="post_user" id="post_user" class="form-control">
    <?php
      $query = "SELECT * FROM users"; // constructing the query
      $select_users = mysqli_query($connection, $query);

      confirmQuery($select_users);

      // Had to put it in the while loop all else everything crashes
      while($row = mysqli_fetch_assoc($select_users)) {
          $user_id = $row['user_id'];
          $username = $row['username'];

          echo "<option value='{$username}'>{$username}</option>";
      }
    ?>
    
    </select>
  </div>


  <!-- <div class="form-group">
    <label for="post_author">Post Author</label>
    <input type="text" class="form-control" id="post_author" name="post_author"> 
  </div> -->


  <div class="form-group">
    <label for="post_status">Post Status</label>
    <select name="post_status" id="post_status" class="form-control">
      <option value="draft">Select Option</option>
      <option value="published">Publish</option>
      <option value="draft">Draft</option>
    </select>
    
  </div>  
  
  
  <div class="form-group">
    <label for="post_image">Post Image</label>
    <input type="file" name="image" id="post_image">
  </div>

  <div class="form-group">
    <label for="post_tags">Post Tags</label>
    <input type="text" class="form-control" id="post_tags" name="post_tags">
  </div>
  
  <div class="form-group">
    <label for="body">Post Content</label>
    <textarea class="form-control "name="post_content" id="body" cols="30" rows="20"></textarea>
  </div>

  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
  </div>


</form>

<!-- Did it like this to avoid error when not on a form page -->
<script>
  initializeckEditor(); 
</script>