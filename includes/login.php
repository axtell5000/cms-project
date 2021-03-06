<?php 
  include "db.php";
  include "../admin/functions.php";
  session_start(); // starting session functionality
  
  if (isset($_POST['login'])) {
    echo $username = escape($_POST['username']);
    echo $password = escape($_POST['password']);

    $username = mysqli_real_escape_string($connection, $username); // cleaning the data
    $password = mysqli_real_escape_string($connection, $password); // cleaning the data

    $query = "SELECT * FROM users WHERE username = '{$username}' ";
    $select_user_query = mysqli_query($connection, $query);

    if (!$select_user_query) {
      die("Query Failed". mysqli_error($connection));
    }

    while($row = mysqli_fetch_array($select_user_query)) {
      $db_user_id = $row['user_id'];
      $db_username = $row['username'];
      $db_password = $row['user_password'];
      $db_user_firstname = $row['user_firstname'];
      $db_user_lastname = $row['user_lastname'];
      $db_user_role = $row['user_role'];
    }

    // $password = crypt($password, $db_user_password);

    if (password_verify($password, $db_password)) {
   
      $_SESSION['username'] = $db_username;
      $_SESSION['firstname'] = $db_user_firstname;
      $_SESSION['lastname'] = $db_user_lastname;
      $_SESSION['user_role'] = $db_user_role;

      header('Location: ../admin');
    } else {
      header('Location: ../index.php');
    }
  }

?>