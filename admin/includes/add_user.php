
<?php

  if(isset($_POST['create_user'])) {    
    $user_firstname = $_POST['user_firstname'];
    $user_lastname  = $_POST['user_lastname'];
    $user_role      = $_POST['user_role'];

    // $post_image        = $_FILES['image']['name'];
    // $post_image_temp   = $_FILES['image']['tmp_name'];

    $username       = $_POST['username'];
    $user_email     = $_POST['user_email'];
    $user_password  = $_POST['user_password'];
    
    $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10));
    // move_uploaded_file($post_image_temp, "../images/$post_image");

    $query = "INSERT INTO users(user_firstname, user_lastname, user_role, username, user_email, user_password) ";
    $query .= "VALUES('{$user_firstname}','{$user_lastname}','{$user_role}','{$username}','{$user_email}', '{$user_password}') "; 
    $create_user_query = mysqli_query($connection, $query);
    
    confirmQuery($create_user_query);

    echo "<div class='alert alert-success' role='alert'> User has been created successfully <a href='users.php'> View User </a> </div>";
  }

?>

<!-- BIG NB - enctype="multipart/form-data" means sending different form data e.g images -->
<form action="" method="post" enctype="multipart/form-data">         
  
  <div class="form-group">
    <label for="user_firstname">Firstname</label>
    <input type="text" class="form-control" name="user_firstname" id="user_firstname">
  </div>

  <div class="form-group">
    <label for="user_lastname">Lastname</label>
    <input type="text" class="form-control" name="user_lastname" id="user_lastname">
  </div>

  <div class="form-group">
    <label for="user_role">User Role</label><br>
    <select name="user_role" id="user_role">
      <option value="subscriber" default>Select options</option>
      <option value="admin">Admin</option>
      <option value="subscriber">Subscriber</option>
    </select>
  </div>
      
  <div class="form-group">
    <label for="user_email">Email</label>
    <input type="email" class="form-control" name="user_email" id="user_email"> 
  </div>

  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" name="username" id="username"> 
  </div>
  
  <div class="form-group">
    <label for="user_password">Password</label>
    <input type="password" class="form-control" name="user_password" id="user_password">
  </div>

  
  <!-- <div class="form-group">
    <label for="post_image">Post Image</label>
    <input type="file"  name="image">
  </div> -->

  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="create_user" value="Add User">
  </div>


</form>