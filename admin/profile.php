<?php include "includes/header.php"; 

  if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    $query = "SELECT * FROM users WHERE username = '{$username}' ";
    $select_user_profile_query = mysqli_query($connection, $query);

    while($row = mysqli_fetch_array($select_user_profile_query)) {
      $user_id          = $row['user_id'];
      $username         = $row['username'];
      $user_password    = $row['user_password'];
      $user_firstname   = $row['user_firstname'];
      $user_lastname    = $row['user_lastname'];
      $user_email       = $row['user_email'];
      // $user_image       = $row['user_image'];
      $user_role        = $row['user_role'];
    }
  }

  // to update database with changes to user profile
  if(isset($_POST['update_profile'])) {    
    $user_firstname = $_POST['user_firstname'];
    $user_lastname  = $_POST['user_lastname'];
    $user_role      = $_POST['user_role'];
  
    // $post_image        = $_FILES['image']['name'];
    // $post_image_temp   = $_FILES['image']['tmp_name'];
  
    $username       = $_POST['username'];
    $user_email     = $_POST['user_email'];
    $user_password  = $_POST['user_password'];
    
  
    // move_uploaded_file($post_image_temp, "../images/$post_image");
    $query = "UPDATE users SET ";
    $query .="user_firstname  = '{$user_firstname}', ";
    $query .="user_lastname  = '{$user_lastname}', "; 
    $query .="username = '{$username}', ";
    $query .="user_password = '{$user_password}', ";
    $query .="user_email   = '{$user_email}', ";
    $query .="user_role= '{$user_role}' ";
    $query .= "WHERE username = '{$username}' ";
  
    $edit_user_query = mysqli_query($connection,$query);
  
    confirmQuery($edit_user_query);
  }

?>

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
                  <option value="subscriber"><?php echo $user_role ?></option>
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
                <input type="password" class="form-control" value="<?php echo $user_password; ?>" name="user_password" id="user_password">
              </div>


              <!-- <div class="form-group">
                <label for="post_image">Post Image</label>
                <input type="file"  name="image">
              </div> -->

              <div class="form-group">
                <input class="btn btn-primary" type="submit" name="update_profile" value="Update Profile">
              </div>


            </form>

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