<?php
require('connect-db.php');

function addSellItem($userId, $category, $brand, $size, $color, $condition, $description, $price) {
    global $db;

    $query = "INSERT INTO item (userId, category, brand, size, color, cond, description, price) 
            VALUES (:userId, :category, :brand, :size, :color, :condition, :description, :price)";
    
    $statement = $db->prepare($query);

    $statement->bindValue(':userId', $userId);
    $statement->bindValue(':category', $category);
    $statement->bindValue(':brand', $brand);
    $statement->bindValue(':size', $size);
    $statement->bindValue(':color', $color);
    $statement->bindValue(':condition', $condition);
    $statement->bindValue(':description', $description);
    $statement->bindValue(':price', $price);

    if ($statement->execute()) {
        //echo "New record created successfully for item";

        // Display success message
        // Source: https://stackoverflow.com/questions/2426304/how-to-hide-a-div-after-some-time-period
        echo '<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>';
        echo '<div id="successMessage" class="alert alert-success">Item successfully listed!</div>';
    
        echo '<script type="text/javascript">';
        echo '$(document).ready( function() {
              $("#successMessage").delay(1500).fadeOut();
              });';
        echo '</script>';
    } else {
        echo '<div class="alert alert-danger">There was a problem listing your item.</div>';
    }
    $statement->closeCursor();

}


function testPls($userId, $desc, $price, $ctg, $size, $cond){
    global $db;

    $query = "INSERT INTO plsTest (userId, description, price, category, size, cond) VALUES (:userId, :dsc, :price, :category, :size, :cond)";
    $statement = $db->prepare($query);

    $statement->bindValue(':userId', $userId);
    $statement->bindValue(':dsc', $desc);
    $statement->bindValue(':price', $price);
    $statement->bindValue(':category', $ctg);
    $statement->bindValue(':size', $size);
    $statement->bindValue(':cond', $cond);

    //$statement->execute();            // this performs twice

    if ($statement->execute()) {
        echo "New record created successfully";
      } else {
        echo "Unable to create record";
      }

    $statement->closeCursor();

}
?>