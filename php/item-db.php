<?php
// Author: Courtney Jacobs (cj5he), Amara Vo (av2jf)
require('connect-db.php');
 
// Returns all items for a user with given id
function getUserItems($id) {
    global $db;

    $query = "SELECT id, userId, category, brand, size, color, cond, description, price FROM item WHERE userId=:id";
    $statement = $db->prepare($query);
    $statement->bindValue(':id', intval($id)); 
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();
    return $results;
}

// Returns 4 most recently listed items to display on home page
function get4RecentItems() {
    global $db;

    $query = "SELECT id, userId, category, brand, size, color, cond, description, price FROM item ORDER BY creationDatetime DESC LIMIT 4";
    $statement = $db->prepare($query);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();
    return $results;
}

// Insert item into database
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
function upload($image) {
    global $db;

    $query="insert IGNORE into `items` (`imgVar`) values ('$image')";
    $statement = $db->prepare($query);
    
    mysqli_query($con,$query) or die(mysqli_error($con));

    if ($statement->execute()) {
        // Display success message
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

?>