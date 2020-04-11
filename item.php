<?php
require('connect-db.php');
 
// Returns all items for a user with given id
function getUserItems($id) {
    global $db;

    $query = "SELECT userId, category, brand, size, color, cond, description, price FROM item WHERE userId=:id";
    $statement = $db->prepare($query);
    $statement->bindValue(':id', intval($id)); 
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();
    return $results;
}

// Gets all available items to display in Shop
function getShopItems($filter, $direction) {
    global $db;
    // Default is by most recently added
    if($filter == "") {
        $query = "SELECT userId, category, brand, size, color, cond, description, price FROM item ORDER BY creationDatetime DESC";
    }
    // if filter specified
    else {
        // ascending
        if($direction == "asc") {
            $query = "SELECT userId, category, brand, size, color, cond, description, price FROM item ORDER BY :filter ASC";
        }
        // descending
        if($direction == "desc") {
            $query = "SELECT userId, category, brand, size, color, cond, description, price FROM item ORDER BY :filter DESC";
        }
        // otherwise
        else {
            $query = "SELECT userId, category, brand, size, color, cond, description, price FROM item ORDER BY :filter";
        }
    }
    $statement = $db->prepare($query);
    if($filter != "") {
        $statement->bindValue(':filter', $filter); 
    }
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();
    return $results;
}

// Returns 5 most recently listed items to display on home page
function get5RecentItems() {
    global $db;

    $query = "SELECT userId, category, brand, size, color, cond, description, price FROM item ORDER BY creationDatetime DESC LIMIT 5";
    $statement = $db->prepare($query);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();
    return $results;
}

?>