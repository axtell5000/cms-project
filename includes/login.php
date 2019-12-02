<?php 
  include "db.php";
  
  if (isset($_POST['login'])) {
    echo $username = $_POST['username'];
    echo $password = $_POST['password'];

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

    if ($username !== $db_username && $password !== $db_password) {
      header('Location: ../index.php');
    } else if ($username === $db_username && $password === $db_password) {
      header('Location: ../admin');
    } else {
      header('Location: ../index.php');
    }
  }

?>