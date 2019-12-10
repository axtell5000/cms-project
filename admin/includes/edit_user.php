
<?php

if(isset($_GET['edit_user'])) {  
  $the_user_id = $_GET['edit_user'];

  $query = "SELECT * FROM users WHERE user_id = $the_user_id"; // dont need the {} here because its a number and not a string
  $select_users_query = mysqli_query($connection, $query);

  // Had to put it in the while loop all else everything crashes
  while($row = mysqli_fetch_assoc($select_users_query)) {
    $user_id          = $row['user_id'];
    $username         = $row['username'];
    $user_password    = $row['user_password'];
    $user_firstname   = $row['user_firstname'];
    $user_lastname    = $row['user_lastname'];
    $user_email       = $row['user_email'];
    $user_image       = $row['user_image'];
    $user_role        = $row['user_role'];
  }


  if(isset($_POST['edit_user'])) {    
    $user_firstname = escape($_POST['user_firstname']);
    $user_lastname  = escape($_POST['user_lastname']);
    $user_role      = escape($_POST['user_role']);

    // $post_image        = $_FILES['image']['name'];
    // $post_image_temp   = $_FILES['image']['tmp_name'];

    $username       = escape($_POST['username']);
    $user_email     = escape($_POST['user_email']);
    $user_password  = escape($_POST['user_password']);
    

    // move_uploaded_file($post_image_temp, "../images/$post_image");
    if(!empty($user_password)) {
      $query_password = "SELECT user_password FROM users WHERE user_id = $the_user_id";
      $get_user_query = mysqli_query($connection, $query_password);
      confirmQuery($get_user_query);

      $row = mysqli_fetch_array($get_user_query);
      $db_user_password = $row['user_password'];

      if ($db_user_password != $user_password) {
        $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));
      }

      $query = "UPDATE users SET ";
      $query .="user_firstname  = '{$user_firstname}', ";
      $query .="user_lastname  = '{$user_lastname}', "; 
      $query .="username = '{$username}', ";
      $query .="user_password = '{$hashed_password}', ";
      $query .="user_email   = '{$user_email}', ";
      $query .="user_role= '{$user_role}' ";
      $query .= "WHERE user_id = {$the_user_id} ";
  
      $edit_user_query = mysqli_query($connection,$query);
  
      confirmQuery($edit_user_query);

      echo "User Updated. " . "<a href='users.php'>View Users</a>";
    }

  }
    
} else {
  header("Location: index.php");
}

?>

<!-- BIG NB - enctype="multipart/form-data" means sending different form data e.g images -->
<form action="" method="post" enctype="multipart/form-data">         

  <div class="form-group">
    <label for="user_firstname">Firstname</label>
    <input type="text" class="form-control" value="<?php echo $user_firstname; ?>" name="user_firstname" id="user_firstname">
  </div>

  <div class="form-group">
    <label for="user_lastname">Lastname</label>
    <input type="text" class="form-control" value="<?php echo $user_lastname; ?>" name="user_lastname" id="user_lastname">
  </div>

  <div class="form-group">
    <label for="user_role">User Role</label><br>
    <select name="user_role" id="user_role">
      <option value="<?php echo $user_role ?>"><?php echo $user_role ?></option>
      <?php 
        if ($user_role === 'admin') {
          echo "<option value='subscriber'>subscriber</option>";
        } else {
          echo "<option value='admin'>admin</option>";
        }
      ?>
      
      
    </select>
  </div>
      
  <div class="form-group">
    <label for="user_email">Email</label>
    <input type="email" class="form-control" value="<?php echo $user_email; ?>" name="user_email" id="user_email"> 
  </div>

  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" value="<?php echo $username; ?>" name="username" id="username"> 
  </div>

  <div class="form-group">
    <label for="user_password">Password</label>
    <input autocomplete="off" type="password" class="form-control" name="user_password" id="user_password">
  </div>


  <!-- <div class="form-group">
    <label for="post_image">Post Image</label>
    <input type="file"  name="image">
  </div> -->

  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="edit_user" value="Edit User">
  </div>


</form>