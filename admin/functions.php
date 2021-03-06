<?php

  function escape($string) {
    global $connection;
    return mysqli_real_escape_string($connection, trim($string));
  }

  function confirmQuery($result) {
    global $connection;

    if (!$result) {
      die("Query failed. " . mysqli_error($connection));
    }

  }
  
  function insert_categories() {

    global $connection;

      // Adding a category 
    if (isset($_POST['submit'])) {
        $cat_title = $_POST['cat_title'];

        if($cat_title == "" || empty($cat_title)) {
            echo "This field should not be empty";
        } else {
            $query = "INSERT INTO categories(cat_title) ";
            $query .= "VALUES('{$cat_title}') ";

            $create_category_query = mysqli_query($connection, $query);

            if (!$create_category_query) {
                die("Query Failed" . mysqli_error($connection));
            }
        }
    }
  }

  function findAllCategories() {
    global $connection;

    $query = "SELECT * FROM categories"; // constructing the query
    $select_categories = mysqli_query($connection, $query);

    // Had to put it in the while loop all else everything crashes
    while($row = mysqli_fetch_assoc($select_categories)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        echo "<tr>
                <td>{$cat_id}</td>
                <td>{$cat_title}</td>
                <td><a href='categories.php?delete={$cat_id}'>Delete</a></td>
                <td><a href='categories.php?edit={$cat_id}'>Edit</a></td>
              </tr>";
    }    
  }

  function deleteCategories() {
    global $connection;
    
    if (isset($_GET['delete'])) {
      $the_cat_id = $_GET['delete'];
      $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id} ";
      $delete_query = mysqli_query($connection, $query);
      header("Location: categories.php");
    }
  }

  function recordCount($table) {
    global $connection;
    $query = "SELECT * FROM " . $table;
    $select_all_posts = mysqli_query($connection, $query);
    $result = mysqli_num_rows($select_all_posts);

    // checking if no item in database
    if ($result < 1) {
      return 0;
      
      if(!$result){
        die('QUERY FAILED!!! ' . mysqli_error($connection));
      }
    } else {
        
      if(!$result){
        die('QUERY FAILED!!! ' . mysqli_error($connection));
      }
      
      return $result;
    }
  }

  function checkStatus($table, $column, $status) {
    global $connection;
    
    $query = "SELECT * FROM $table WHERE $column = '{$status}'";
    $result = mysqli_query($connection, $query);
    return mysqli_num_rows($result);
  }
?>