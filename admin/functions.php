<?php
  
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
?>