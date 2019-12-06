
<?php 
  if (isset($_POST['checkboxArray'])) {
    foreach($_POST['checkboxArray'] as $postValueId) {
      $bulk_options = $_POST['bulk_options'];

      switch($bulk_options) {
        case 'published':
          $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId}";
          $update_to_published_status = mysqli_query($connection, $query);
          confirmQuery($update_to_published_status);
          break;

        case 'draft':
          $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId}";
          $update_to_draft_status = mysqli_query($connection, $query);
          confirmQuery($update_to_draft_status);
          break;

        case 'delete':
          $query = "DELETE FROM posts WHERE post_id = {$postValueId}";
          $update_to_delete_status = mysqli_query($connection, $query);
          confirmQuery($update_to_delete_status);
          break;

        default:
          break;
      }
    }
  }
?>


<form action="" method="post">
      
  <div id="bulkOptionsContainer" class="col-xs-3 no-gutters">
    <select name="bulk_options" id="" class="form-control">
      <option value="">Select Option</option>
      <option value="published">Publish</option>
      <option value="draft">Draft</option>
      <option value="delete">Delete</option>
    </select>
  </div>
  
  
  <div class="col-xs-4">
    <input type="submit" name="submit" class="btn btn-success" value="Apply">
    <a href="posts.php?source=add_post" class="btn btn-primary" title="Add New Post">Add New</a>
  </div>
  
  <table class="table table-bordered table-hover">
    <thead>
      <tr>
        <th><input type="checkbox" id="selectAllBoxes"></th>  
        <th>Id</th>
        <th>Author</th>
        <th>Title</th>
        <th>Category</th>
        <th>Status</th>
        <th>Image</th>
        <th>Tags</th>
        <th>Comments</th>
        <th>Date</th>
        <th>View Post</th>
        <th>Edit</th>   
        <th>Delete</th>
        <th>Post Views Count</th>                          
      </tr>
    </thead>
    <tbody>

    <?php 
      $query = "SELECT * FROM posts"; // constructing the query
      $select_posts = mysqli_query($connection, $query);

      // Had to put it in the while loop all else everything crashes
      while($row = mysqli_fetch_assoc($select_posts)) {
        $post_id = $row['post_id'];
        $post_author = $row['post_author'];
        $post_title = $row['post_title'];
        $post_category_id = $row['post_category_id'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_comment_count = $row['post_comment_count'];
        $post_date = $row['post_date'];
        $post_views_count = $row['post_views_count'];

        echo "<tr>";
        ?>
        <td><input type='checkbox' class='checkBoxes' name='checkboxArray[]' value='<?php echo $post_id; ?>'></td>

        <?php
          echo "<td>{$post_id}</td>";
          echo "<td>{$post_author}</td>";
          echo "<td>{$post_title}</td>";
                  
          $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id} "; // constructing the query
          $select_categories_id = mysqli_query($connection, $query);

          while($row = mysqli_fetch_assoc($select_categories_id)) {
              $cat_id = $row['cat_id'];
              $cat_title = $row['cat_title'];
          }
          echo "<td>{$cat_title}</td>";
          echo "<td>{$post_status}</td>";
          echo "<td><img width='200' class='img-responsive' src='../images/{$post_image}' alt='image' /></td>";
          echo "<td>{$post_tags}</td>";
          echo "<td>{$post_comment_count}</td>";
          echo "<td>{$post_date}</td>";
          echo "<td><a href='../post.php?p_id={$post_id}' title='View Post'>View Post</a></td>"; 
          echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}' title='Edit Post'>Edit</a></td>";    
          echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete'); \" href='posts.php?delete={$post_id}' title='Delete Post'>Delete</a></td>"; 
          echo "<td>$post_views_count</td>";     
          echo "</tr>";                          }    
        ?>                    
    </tbody>
  </table>
</form>
<?php 
  if (isset($_GET['delete'])) {
    $the_post_id =$_GET['delete'];
    $query = "DELETE FROM posts WHERE post_id = {$the_post_id}";
    $delete_query = mysqli_query($connection, $query);
    header("Location: view_all_posts.php");
  }

?>