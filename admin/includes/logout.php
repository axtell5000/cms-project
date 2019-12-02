<?php 
  session_start(); // starting session functionality
  
  $_SESSION['username'] = null;
  $_SESSION['firstname'] = null;
  $_SESSION['lastname'] = null;
  $_SESSION['user_role'] = null;

  header("Location: ../index.php");
?>